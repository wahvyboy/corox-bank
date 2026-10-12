<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Create a bank account for user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUserAccount(Request $request)
    {
        $allowedCurrencies = implode(',', CurrencyService::codes());
        $request->validate([
            'account_type' => 'required|in:Checking,Savings,Investment',
            'currency' => 'nullable|string|in:' . $allowedCurrencies,
        ]);

        $currency = strtoupper($request->input('currency', 'USD'));
        if (!CurrencyService::isValid($currency)) {
            $currency = 'USD';
        }

        $account = new Account;
        $account->user_id = Auth::id();
        $account->routing_number = CurrencyService::defaultRouting($currency);
        $account->account_type = $request->account_type;
        $account->currency = $currency;
        $account->balance = 0.00;
        $account->status = 'pending';

        // Generate a random 10-digit account number starting with 100
        $account->account_number = '100' . rand(1000000, 9999999);

        $account->save();

        return redirect('/user/show-bank-accounts')->with('success', 
            "Your Corox Bank {$currency} ({$account->currency_symbol}) account request has been submitted successfully. Please wait for administrator approval.");
    }

    /**
     * Create a bank account for user by admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUserAccountByAdmin(Request $request)
    {
        $allowedCurrencies = implode(',', CurrencyService::codes());
        $request->validate([
            'name' => 'required|string',
            'account_type' => 'required|in:Checking,Savings,Investment',
            'currency' => 'nullable|string|in:' . $allowedCurrencies,
        ]);
    
        $user = User::where('name', $request->name)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $currency = strtoupper($request->input('currency', 'USD'));
        if (!CurrencyService::isValid($currency)) {
            $currency = 'USD';
        }
    
        $account = new Account;
        $account->user_id = $user->id;
        $account->routing_number = CurrencyService::defaultRouting($currency);
        $account->account_type = $request->account_type;
        $account->currency = $currency;
        $account->balance = 0.00;
        $account->status = 'active';
    
        // Generate a random 10-digit account number starting with 100
        $account->account_number = '100' . rand(1000000, 9999999);
    
        $account->save();
    
        return redirect()->route('show.user.accounts', ['user' => $user->id])->with('success', 
            "Active {$currency} ({$account->currency_symbol}) Account created successfully for client {$user->name}.");
    }

    /**
     * Approve/reject account creation or update currency before approval.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveAccount(Request $request, $id)
    {
        $account = Account::find($id);

        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        // Allow admin to choose/override the currency before or upon approval
        if ($request->filled('currency')) {
            $newCurrency = strtoupper(trim($request->input('currency')));
            if (CurrencyService::isValid($newCurrency)) {
                $account->currency = $newCurrency;
                // Update routing / BSB / SWIFT clearing default if requested
                $account->routing_number = CurrencyService::defaultRouting($newCurrency);
            }
        }

        if ($request->action == 'Approve' || $request->action == 'Unblock') {
            $account->status = 'active';
            $msg = "Account #{$account->account_number} approved and activated in {$account->currency} ({$account->currency_symbol}) successfully.";
        } elseif ($request->action == 'Reject' || $request->action == 'Block') {
            $account->status = 'blocked';
            $msg = "Account #{$account->account_number} status updated to blocked.";
        } elseif ($request->action == 'UpdateCurrency') {
            $msg = "Account #{$account->account_number} currency set to {$account->currency} ({$account->currency_symbol}).";
        } else {
            $msg = "Account status updated successfully.";
        }

        $account->save();

        return redirect()->back()->with('success', $msg);
    }

    /**
     * Block users by admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function block($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'inactive';
            $user->save();
        }

        return redirect()->back()->with('success', 'User access blocked successfully.');
    }

    /**
     * Unblock users by admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function unblock($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = 'active';
            $user->save();
        }

        return redirect()->back()->with('success', 'User access unblocked successfully.');
    }
}
