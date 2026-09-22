<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if (Auth::check()) { // if user is logged in
            // Check the user's role and redirect accordingly
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        }
        return view('register');
    }

    /**
     * Handle the registration form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:users',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'account_type_requested' => 'required|string|in:Checking,Savings',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'account_type_requested' => $request->account_type_requested,
            'password' => bcrypt($request->password),
            'role' => 'user',
            'status' => 'active',
        ]);

        // Auto-generate initial bank account application request
        $account_number = rand(1000000000, 9999999999);
        Account::create([
            'user_id' => $user->id,
            'account_number' => (string) $account_number,
            'routing_number' => '026009593',
            'account_type' => $request->account_type_requested,
            'balance' => 0.00,
            'currency' => 'USD',
            'status' => 'pending'
        ]);

        Auth::login($user);

        return redirect('/user/dashboard')->with('success', 'Account application submitted successfully! Your account is pending admin approval.');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        if (Auth::check()) { // if user is logged in
            // Check the user's role and redirect accordingly
            if (Auth::user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        }
        return view('login');
    }

    /**
     * Handle the login form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = trim($request->input('name'));
        $password = $request->input('password');

        // Look up by username, email, or full name, case-insensitively with trimmed input
        $user = User::whereRaw('LOWER(name) = ?', [strtolower($loginInput)])
                    ->orWhereRaw('LOWER(email) = ?', [strtolower($loginInput)])
                    ->orWhereRaw('LOWER(full_name) = ?', [strtolower($loginInput)])
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            // Check if the user is inactive
            if ($user->status == 'inactive') {
                return back()->withErrors([
                    'loginError' => 'Your account has been blocked.',
                ]);
            }

            // Update live last login timestamp safely
            try {
                if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'last_login_at')) {
                    $user->update([
                        'last_login_at' => now(),
                    ]);
                }
            } catch (\Throwable $e) {
                // Prevent login crash if column is pending migration
            }

            Auth::login($user, $request->boolean('remember'));

            // Check the user's role and redirect accordingly
            if ($user->role == 'admin') {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/user/dashboard');
            }
        }

        return back()->withErrors([
            'loginError' => 'Invalid credentials.',
        ]);
    }


    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserDashboard()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                $user = Auth::user();
                $accounts = $user->accounts()->where('status', 'active')->get();
                $totalBalance = $accounts->sum('balance');
                $recentTransactions = Transaction::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->take(5)
                    ->get();
                return view('userDashboard', compact('accounts', 'totalBalance', 'recentTransactions'));
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Create Bank Account form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCreateBankAccountForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('create-bank-account');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Bank Accounts list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBankAccounts()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                $accounts = Auth::user()->accounts()->paginate(10);
                return view('bank-accounts', ['accounts' => $accounts]);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Transaction history list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTransactionHistory(Request $request)
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                $userAccountIds = Auth::user()->accounts()->pluck('id');
                $query = Transaction::where(function ($q) use ($userAccountIds) {
                    $q->where('user_id', Auth::id())
                      ->orWhereIn('from_account_id', $userAccountIds)
                      ->orWhereIn('to_account_id', $userAccountIds);
                });

                if ($request->filled('account_number')) {
                    $account_number = $request->input('account_number');
                    $query->where(function ($query) use ($account_number) {
                        $query->whereHas('fromAccount', function ($query) use ($account_number) {
                            $query->where('account_number', $account_number);
                        })->orWhereHas('toAccount', function ($query) use ($account_number) {
                            $query->where('account_number', $account_number);
                        });
                    });
                }
                if ($request->filled('timestamp')) {
                    $query->whereDate('created_at', $request->input('timestamp'));
                }
                if ($request->filled('transaction_type')) {
                    $query->where('transaction_type', $request->input('transaction_type'));
                }

                $transactions = $query->orderBy('created_at', 'desc')->paginate(15);
                return view('transactions', ['transactions' => $transactions]);
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Withdraw form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showWithdrawForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('withdraw');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Deposit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showDepositForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('deposit');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Transfer form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTransferForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role != 'admin') {
                return view('transfer');
            } else {
                return redirect('admin/dashboard');
            }
        }
        return redirect('/');
    }


    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminDashboard()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is an admin
            if (Auth::user()->role == 'admin') {
                return view('adminDashboard');
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the Users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUsers()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is an admin
            if (Auth::user()->role == 'admin') {
                $users = User::paginate(10);
                return view('users', ['users' => $users]);
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the user Accounts list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserAccounts($id)
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is an admin
            if (Auth::user()->role == 'admin') {
                $accounts = User::find($id)->accounts()->paginate(10);
                $user = User::find($id);
                return view('user-accounts', ['accounts' => $accounts, 'user' => $user]);
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the user Transactions list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserTransactions(Request $request, $id)
    {
        $user = User::find($id);

        if (Auth::check()) { // if user is logged in
            // Ensure the user is an admin
            if (Auth::user()->role == 'admin') {
                $query = Transaction::query();

                if ($request->filled('account_number')) {
                    $account_number = $request->input('account_number');
                    $query->where(function ($query) use ($account_number) {
                        $query->whereHas('fromAccount', function ($query) use ($account_number) {
                            $query->where('account_number', $account_number);
                        })->orWhereHas('toAccount', function ($query) use ($account_number) {
                            $query->where('account_number', $account_number);
                        });
                    });
                }
                if ($request->filled('timestamp')) {
                    $query->whereDate('created_at', $request->input('timestamp'));
                }
                if ($request->filled('transaction_type')) {
                    $query->where('transaction_type', $request->input('transaction_type'));
                }

                $transactions = $query->paginate(10);
                return view('user-transactions', ['transactions' => $transactions, 'user' => $user]);
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the requests list.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRequests()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is an admin
            if (Auth::user()->role == 'admin') {
                $accounts = Account::paginate(10);
                return view('requests', ['accounts' => $accounts]);
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the admin Withdraw form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminWithdrawForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role == 'admin') {
                return view('admin-withdraw');
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the admin Deposit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminDepositForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role == 'admin') {
                return view('admin-deposit');
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the admin Transfer form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminTransferForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role == 'admin') {
                return view('admin-transfer');
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Show the admin Create Account form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminCreateAccountForm()
    {
        if (Auth::check()) { // if user is logged in
            // Ensure the user is not an admin
            if (Auth::user()->role == 'admin') {
                return view('admin-create-account');
            } else {
                return redirect('user/dashboard');
            }
        }
        return redirect('/');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}

