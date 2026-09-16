<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;
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
        $request->validate([
            'account_type' => 'required|in:Checking,Savings',
        ]);

        $account = new Account;
        $account->user_id = Auth::id();
        $account->routing_number = '026009593';
        $account->account_type = $request->account_type;
        $account->currency = 'USD';
        $account->balance = 0.00;
        $account->status = 'pending';

        // Generate a random 10-digit account number starting with 100
        $account->account_number = '100' . rand(1000000, 9999999);

        $account->save();

        return redirect('/user/show-bank-accounts')->with('success', 
                        'Your Corox Bank USD account request has been submitted successfully. Please wait for administrator approval.');
    }

    /**
     * Create a bank account for user by admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createUserAccountByAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'account_type' => 'required|in:Checking,Savings',
        ]);
    
        $user = User::where('name', $request->name)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
    
        $account = new Account;
        $account->user_id = $user->id;
        $account->routing_number = '026009593';
        $account->account_type = $request->account_type;
        $account->currency = 'USD';
        $account->balance = 0.00;
        $account->status = 'active';
    
        // Generate a random 10-digit account number starting with 100
        $account->account_number = '100' . rand(1000000, 9999999);
    
        $account->save();
    
        return redirect()->route('show.user.accounts', ['user' => $user->id])->with('success', 
                                 'USD Account created successfully for client.');
    }

    /**
     * Approve/reject account creation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveAccount(Request $request, $id)
    {
        $account = Account::find($id);

        if (!$account) {
            return redirect()->back()->with('error', 'Account not found.');
        }

        if ($request->action == 'Approve' || $request->action == 'Unblock') {
            $account->status = 'active';
        } elseif ($request->action == 'Reject' || $request->action == 'Block') {
            $account->status = 'blocked';
        }

        $account->save();

        return redirect()->back()->with('success', 'Account status updated successfully.');
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
