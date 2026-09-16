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
        $transaction->routing_number = $account->routing_number ?? '026009593';
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
        $transaction->routing_number = $account->routing_number ?? '026009593';
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

        // Deduct from sender's account
        $from_account->balance -= $request->amount;
        $from_account->save();

        // Check if destination account exists internally within Corox Bank
        $to_account = Account::where('account_number', $request->to_account_number)->first();

        $routing = $request->routing_number ?: '026009593';
        $memo = $request->description ?: 'USD Wire Transfer to Account: ' . $request->to_account_number;

        if ($to_account) {
            // Internal Transfer
            $to_account->balance += $request->amount;
            $to_account->save();

            $transaction = new Transaction;
            $transaction->amount = $request->amount;
            $transaction->transaction_type = 'transfer';
            $transaction->routing_number = $routing;
            $transaction->description = 'Internal Wire Transfer — ' . $memo;
            $transaction->user_id = $from_account->user_id;
            $transaction->from_account_id = $from_account->id;
            $transaction->to_account_id = $to_account->id;
            $transaction->save();

            return redirect('/user/show-transaction-history')
                ->with('success', 'Internal wire transfer of $' . number_format($request->amount, 2) . ' executed successfully to account #' . $request->to_account_number . '.')
                ->with('receipt_id', $transaction->id);
        } else {
            // External Wire Transfer (to external bank)
            $transaction = new Transaction;
            $transaction->amount = $request->amount;
            $transaction->transaction_type = 'transfer';
            $transaction->routing_number = $routing;
            $transaction->description = 'External Wire Transfer to Account: ' . $request->to_account_number . ' (ABA Routing: ' . $routing . ') — ' . $memo;
            $transaction->user_id = $from_account->user_id;
            $transaction->from_account_id = $from_account->id;
            $transaction->to_account_id = null;
            $transaction->save();

            return redirect('/user/show-transaction-history')
                ->with('success', 'Outbound external wire transfer of $' . number_format($request->amount, 2) . ' executed successfully to account #' . $request->to_account_number . ' (Routing: ' . $routing . ').')
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
        $transaction->routing_number = $account->routing_number ?? '026009593';
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
        $transaction->routing_number = $account->routing_number ?? '026009593';
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
        $routing = $request->routing_number ?: '026009593';

        if ($to_account) {
            $to_account->balance += $request->amount;
            $to_account->save();
        }

        // Create a new transaction record
        $transaction = new Transaction;
        $transaction->amount = $request->amount;
        $transaction->transaction_type = 'transfer';
        $transaction->routing_number = $routing;
        $transaction->description = 'Administrative Wire Override to Account: ' . $request->to_account_number . ' (ABA Routing: ' . $routing . ')';
        $transaction->user_id = $from_account->user_id;
        $transaction->from_account_id = $from_account->id;
        $transaction->to_account_id = $to_account ? $to_account->id : null;
        $transaction->save();

        return redirect()->route('show.user.transactions', ['user' => $from_account->user_id])->with('success', 'Administrative wire transfer executed.');
    }
}
