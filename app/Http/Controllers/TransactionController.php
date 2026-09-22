<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Perform a withdrawal transaction for clients.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientWithdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Invalid account number or amount.']);
        }

        $account = Account::where('account_number', $request->account_number)
                  ->where('user_id', Auth::id())
                  ->first();

        if (!$account) {
            return redirect()->back()->with(['error' => 'Account not found or access denied.']);
        }
        if ($account->status == 'pending') {
            return redirect()->back()->with(['error' => 'This account is still pending administrator approval.']);
        }
        if ($account->status == 'blocked') {
            return redirect()->back()->with(['error' => 'This account has been blocked.']);
        }
        if ($account->balance < $request->amount) {
            return redirect()->back()->with(['error' => 'Insufficient USD balance in account.']);
        }

        $account->balance -= $request->amount;
        $account->save();

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'withdraw';
        $transaction->routing_number = $account->routing_number ?? '071923456';
        $transaction->description = $request->description ?? 'ATM / Client Withdrawal';
        $transaction->user_id = $account->user_id;
        $transaction->from_account_id = $account->id;
        $transaction->save();

        return redirect('/user/show-transaction-history')->with('success', 'Withdrawal of $' . number_format($request->amount, 2) . ' processed successfully.');
    }

    /**
     * Perform a deposit transaction for clients.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientDeposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Invalid account number or amount.']);
        }

        $account = Account::where('account_number', $request->account_number)
                  ->where('user_id', Auth::id())
                  ->first();

        if (!$account) {
            return redirect()->back()->with(['error' => 'Account not found or access denied.']);
        }
        if ($account->status == 'pending') {
            return redirect()->back()->with(['error' => 'This account is still pending administrator approval.']);
        }
        if ($account->status == 'blocked') {
            return redirect()->back()->with(['error' => 'This account has been blocked.']);
        }

        $account->balance += $request->amount;
        $account->save();

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'deposit';
        $transaction->routing_number = $account->routing_number ?? '071923456';
        $transaction->description = $request->description ?? 'Direct Deposit / Credit';
        $transaction->user_id = $account->user_id;
        $transaction->to_account_id = $account->id;
        $transaction->save();

        return redirect('/user/show-transaction-history')->with('success', 'Deposit of $' . number_format($request->amount, 2) . ' credited successfully.');
    }

    /**
     * Perform a transfer transaction for clients (ACH / Wire to any internal or external account).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientTransfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_account_number' => 'required|exists:accounts,account_number',
            'to_account_number' => 'required|string|max:50',
            'routing_number' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Please provide a valid source account, destination account, and positive transfer amount.']);
        }

        $from_account = Account::where('account_number', $request->from_account_number)
                  ->where('user_id', Auth::id())
                  ->first();

        if (!$from_account) {
            return redirect()->back()->with(['error' => 'Source account not found or access denied.']);
        }
        if ($from_account->status == 'pending') {
            return redirect()->back()->with(['error' => 'Source account is pending administrator approval.']);
        }
        if ($from_account->status == 'blocked') {
            return redirect()->back()->with(['error' => 'Source account has been blocked.']);
        }
        if ($from_account->balance < $request->amount) {
            return redirect()->back()->with(['error' => 'Insufficient USD balance in source account.']);
        }

        // Deduct from sender's account (funds held in escrow)
        $from_account->balance -= $request->amount;
        $from_account->save();

        // Check if destination account exists internally within Corox Bank
        $to_account = Account::where('account_number', $request->to_account_number)->first();

        $routing = $request->routing_number ?: '071923456';
        $memo = $request->description ?: 'USD Wire Transfer to Account: ' . $request->to_account_number;
        $clearingDate = \Carbon\Carbon::now()->addDay()->toDateString();

        if ($to_account) {
            // Internal Transfer — Pending Admin Clearance & Settlement
            $transaction = new Transaction;
            $transaction->amount = $request->amount;
            $transaction->transaction_type = 'transfer';
            $transaction->status = 'pending';
            $transaction->clearing_date = $clearingDate;
            $transaction->deposit_method = 'wire';
            $transaction->routing_number = $routing;
            $transaction->description = 'Internal Wire Transfer — ' . $memo;
            $transaction->user_id = $from_account->user_id;
            $transaction->from_account_id = $from_account->id;
            $transaction->to_account_id = $to_account->id;
            $transaction->save();

            return redirect('/user/show-transaction-history')
                ->with('success', 'Internal wire transfer of $' . number_format($request->amount, 2) . ' submitted. Status: PENDING (Clears Tomorrow / Next Business Day). Awaiting administrative clearance.')
                ->with('receipt_id', $transaction->id);
        } else {
            // External Wire Transfer (to external bank) — Pending Admin Clearance
            $receivingBank = Transaction::resolveBankByRouting($routing);
            $transaction = new Transaction;
            $transaction->amount = $request->amount;
            $transaction->transaction_type = 'transfer';
            $transaction->status = 'pending';
            $transaction->clearing_date = $clearingDate;
            $transaction->deposit_method = 'wire';
            $transaction->routing_number = $routing;
            $transaction->description = 'External Wire Transfer to ' . $receivingBank . ' (Account: ' . $request->to_account_number . ', ABA: ' . $routing . ') — ' . $memo;
            $transaction->user_id = $from_account->user_id;
            $transaction->from_account_id = $from_account->id;
            $transaction->to_account_id = null;
            $transaction->save();

            return redirect('/user/show-transaction-history')
                ->with('success', 'Outbound wire transfer of $' . number_format($request->amount, 2) . ' submitted. Status: PENDING (Clears Tomorrow / Next Business Day). Awaiting administrative clearance.')
                ->with('receipt_id', $transaction->id);
        }
    }

    /**
     * Show official digital transaction receipt.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showReceipt($id)
    {
        $transaction = Transaction::with(['user', 'fromAccount.user', 'toAccount.user'])->findOrFail($id);

        // Security authorization check
        if (Auth::user()->role !== 'admin') {
            $fromUserId = $transaction->fromAccount ? $transaction->fromAccount->user_id : null;
            $toUserId = $transaction->toAccount ? $transaction->toAccount->user_id : null;
            if ($transaction->user_id !== Auth::id() && $fromUserId !== Auth::id() && $toUserId !== Auth::id()) {
                abort(403, 'Unauthorized access to transaction receipt.');
            }
        }

        return view('receipt', compact('transaction'));
    }

    /**
     * Perform a withdrawal transaction for admins.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminWithdraw(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }

        $account = Account::where('account_number', $request->account_number)->first();

        if (!$account) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }

        if ($account->balance < $request->amount) {
            return redirect()->back()->with(['error' => 'Insufficient balance in account.']);
        }

        $account->balance -= $request->amount;
        $account->save();

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'withdraw';
        $transaction->routing_number = $account->routing_number ?? '071923456';
        $transaction->description = 'Administrative Ledger Withdrawal';
        $transaction->user_id = $account->user_id;
        $transaction->from_account_id = $account->id;
        $transaction->save();

        return redirect()->route('show.user.transactions', ['user' => $account->user_id])->with('success', 'Administrative withdrawal processed.');
    }

    /**
     * Perform a deposit transaction for admins.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminDeposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }

        $account = Account::where('account_number', $request->account_number)->first();

        if (!$account) {
            return redirect()->back()->with(['error' => 'Account not found.']);
        }

        $account->balance += $request->amount;
        $account->save();

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'deposit';
        $transaction->routing_number = $account->routing_number ?? '071923456';
        $transaction->description = 'Administrative Ledger Deposit';
        $transaction->user_id = $account->user_id;
        $transaction->to_account_id = $account->id;
        $transaction->save();

        return redirect()->route('show.user.transactions', ['user' => $account->user_id])->with('success', 'Administrative deposit processed.');
    }

    /**
     * Perform a transfer transaction for admins.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminTransfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from_account_number' => 'required|exists:accounts,account_number',
            'to_account_number' => 'required|string|max:50',
            'routing_number' => 'nullable|string|max:50',
            'amount' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->with(['error' => 'Please provide valid source account and transfer amount.']);
        }

        $from_account = Account::where('account_number', $request->from_account_number)->first();

        if (!$from_account) {
            return redirect()->back()->with(['error' => 'Source account not found.']);
        }
        if ($from_account->balance < $request->amount) {
            return redirect()->back()->with(['error' => 'Insufficient balance in source account.']);
        }

        $from_account->balance -= $request->amount;
        $from_account->save();

        $to_account = Account::where('account_number', $request->to_account_number)->first();
        $routing = $request->routing_number ?: '071923456';

        if ($to_account) {
            $to_account->balance += $request->amount;
            $to_account->save();
        }

        $receivingBank = Transaction::resolveBankByRouting($routing);

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'transfer';
        $transaction->routing_number = $routing;
        $transaction->description = 'Administrative Wire Override to ' . $receivingBank . ' (Account: ' . $request->to_account_number . ', ABA: ' . $routing . ')';
        $transaction->user_id = $from_account->user_id;
        $transaction->from_account_id = $from_account->id;
        $transaction->to_account_id = $to_account ? $to_account->id : null;
        $transaction->save();

        return redirect()->route('show.user.transactions', ['user' => $from_account->user_id])->with('success', 'Administrative wire transfer executed.');
    }

    /**
     * Show mobile check deposit camera / upload form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckDepositForm()
    {
        if (!Auth::check() || Auth::user()->role === 'admin') {
            return redirect('/login');
        }

        $accounts = Auth::user()->accounts()->where('status', 'active')->get();
        return view('deposit-check', compact('accounts'));
    }

    /**
     * Process a mobile check deposit submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clientDepositCheck(Request $request)
    {
        $request->validate([
            'account_number' => 'required|exists:accounts,account_number',
            'amount' => 'required|numeric|min:1',
            'check_front' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'check_back' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'check_number' => 'nullable|string|max:50',
        ]);

        $account = Account::where('account_number', $request->account_number)
                          ->where('user_id', Auth::id())
                          ->first();

        if (!$account) {
            return redirect()->back()->with(['error' => 'Account not found or access denied.']);
        }
        if ($account->status !== 'active') {
            return redirect()->back()->with(['error' => 'Selected account is not active.']);
        }

        // Store check images in public/uploads/checks
        $uploadDir = public_path('uploads/checks');
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $frontFileName = 'chk_front_' . time() . '_' . rand(1000, 9999) . '.' . $request->file('check_front')->getClientOriginalExtension();
        $request->file('check_front')->move($uploadDir, $frontFileName);
        $frontPath = 'uploads/checks/' . $frontFileName;

        $backFileName = 'chk_back_' . time() . '_' . rand(1000, 9999) . '.' . $request->file('check_back')->getClientOriginalExtension();
        $request->file('check_back')->move($uploadDir, $backFileName);
        $backPath = 'uploads/checks/' . $backFileName;

        $checkNum = $request->check_number ?: ('CHK-' . rand(1000, 9999));
        $clearingDate = \Carbon\Carbon::now()->addDay()->toDateString();

        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'deposit';
        $transaction->status = 'pending';
        $transaction->clearing_date = $clearingDate;
        $transaction->deposit_method = 'check';
        $transaction->routing_number = $account->routing_number ?? '071923456';
        $transaction->description = 'Mobile Check Deposit #' . $checkNum . ' — Pending Settlement';
        $transaction->check_front_image = $frontPath;
        $transaction->check_back_image = $backPath;
        $transaction->check_number = $checkNum;
        $transaction->user_id = $account->user_id;
        $transaction->to_account_id = $account->id;
        $transaction->save();

        return redirect('/user/show-transaction-history')
            ->with('success', 'Check #' . $checkNum . ' for $' . number_format($request->amount, 2) . ' submitted successfully! Status: PENDING (Clears Tomorrow upon admin review).')
            ->with('receipt_id', $transaction->id);
    }

    /**
     * Show pending transactions (wires & check deposits) for admin approval.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showPendingTransactions(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $type = $request->query('type');
        $query = Transaction::with(['user', 'fromAccount', 'toAccount'])->where('status', 'pending');

        if ($type === 'check') {
            $query->where('deposit_method', 'check');
        } elseif ($type === 'wire') {
            $query->where('deposit_method', 'wire');
        }

        $pendingTransactions = $query->orderBy('created_at', 'desc')->paginate(15);
        $pendingCount = Transaction::where('status', 'pending')->count();
        $pendingChecksCount = Transaction::where('status', 'pending')->where('deposit_method', 'check')->count();
        $pendingWiresCount = Transaction::where('status', 'pending')->where('deposit_method', 'wire')->count();

        return view('admin-pending-transactions', compact(
            'pendingTransactions',
            'pendingCount',
            'pendingChecksCount',
            'pendingWiresCount',
            'type'
        ));
    }

    /**
     * Admin approves a pending transaction (clears check deposit or settles wire).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveTransaction($id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $transaction = Transaction::with(['fromAccount', 'toAccount'])->findOrFail($id);

        if ($transaction->status !== 'pending') {
            return redirect()->back()->with('error', 'This transaction is not in pending status.');
        }

        // If check deposit: credit destination account
        if ($transaction->deposit_method === 'check' && $transaction->toAccount) {
            $transaction->toAccount->increment('balance', $transaction->amount);
        }

        // If internal wire transfer: credit destination account
        if ($transaction->transaction_type === 'transfer' && $transaction->toAccount) {
            $transaction->toAccount->increment('balance', $transaction->amount);
        }

        $transaction->status = 'completed';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction #' . $transaction->id . ' has been APPROVED and successfully settled.');
    }

    /**
     * Admin rejects a pending transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectTransaction(Request $request, $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/login');
        }

        $transaction = Transaction::with(['fromAccount', 'toAccount'])->findOrFail($id);

        if ($transaction->status !== 'pending') {
            return redirect()->back()->with('error', 'This transaction is not in pending status.');
        }

        // If wire transfer: refund sender's account
        if ($transaction->transaction_type === 'transfer' && $transaction->fromAccount) {
            $transaction->fromAccount->increment('balance', $transaction->amount);
        }

        $reason = $request->input('reason', 'Administrative decision / Verification check failure');
        $transaction->status = 'rejected';
        $transaction->description .= ' [REJECTED: ' . $reason . ']';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction #' . $transaction->id . ' has been REJECTED.' . ($transaction->fromAccount ? ' Funds refunded to client account.' : ''));
    }
}
