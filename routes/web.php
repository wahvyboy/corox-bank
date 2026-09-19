<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes - Corox Bank Commercial & Digital Banking Platform
|--------------------------------------------------------------------------
*/

// Public Informational Pages
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/personal', function () {
    return view('personal');
})->name('personal');

Route::get('/business', function () {
    return view('business');
})->name('business');

Route::get('/loans', function () {
    return view('loans');
})->name('loans');

Route::get('/cards', function () {
    return view('cards');
})->name('cards');

Route::get('/wealth', function () {
    return view('wealth');
})->name('wealth');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/security', function () {
    return view('security');
})->name('security');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// User Registration & Authentication
Route::get('register', 'App\Http\Controllers\UserController@showRegistrationForm')->name('register');
Route::post('register', 'App\Http\Controllers\UserController@register');
Route::get('login', 'App\Http\Controllers\UserController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\UserController@login');
Route::post('logout', 'App\Http\Controllers\UserController@logout')->name('logout');

// User & Admin Dashboards
Route::get('/user/dashboard', 'App\Http\Controllers\UserController@showUserDashboard')->name('user.dashboard');
Route::get('/admin/dashboard', 'App\Http\Controllers\UserController@showAdminDashboard')->name('admin.dashboard');

// Client Operation Routes
Route::get('/user/create-bank-account', 'App\Http\Controllers\UserController@showCreateBankAccountForm')->name('create.bank.account');
Route::get('/user/show-bank-accounts', 'App\Http\Controllers\UserController@showBankAccounts')->name('show.bank.accounts');
Route::get('/user/show-transaction-history', 'App\Http\Controllers\UserController@showTransactionHistory')->name('show.transaction.history');
Route::get('/user/withdraw', 'App\Http\Controllers\UserController@showWithdrawForm')->name('show.withdraw.form');
Route::get('/user/deposit', 'App\Http\Controllers\UserController@showDepositForm')->name('show.deposit.form');
Route::get('/user/transfer', 'App\Http\Controllers\UserController@showTransferForm')->name('show.transfer.form');
Route::get('/user/transaction/{id}/receipt', 'App\Http\Controllers\TransactionController@showReceipt')->name('transaction.receipt');

// Admin Operation Routes
Route::get('/admin/show-users', 'App\Http\Controllers\UserController@showUsers')->name('show.users');
Route::get('/admin/{user}/show-user-accounts', 'App\Http\Controllers\UserController@showUserAccounts')->name('show.user.accounts');
Route::get('/admin/{user}/show-user-transactions', 'App\Http\Controllers\UserController@showUserTransactions')->name('show.user.transactions');
Route::get('/admin/show-requests', 'App\Http\Controllers\UserController@showRequests')->name('show.requests');
Route::get('/admin/withdraw', 'App\Http\Controllers\UserController@showAdminWithdrawForm')->name('show.admin.withdraw.form');
Route::get('/admin/deposit', 'App\Http\Controllers\UserController@showAdminDepositForm')->name('show.admin.deposit.form');
Route::get('/admin/transfer', 'App\Http\Controllers\UserController@showAdminTransferForm')->name('show.admin.transfer.form');
Route::get('/admin/create-bank-account', 'App\Http\Controllers\UserController@showAdminCreateAccountForm')->name('show.admin.create.account.form');

// Account Action Routes (Client)
Route::post('/user/create-bank-account', 'App\Http\Controllers\AccountController@createUserAccount');
Route::post('/user/withdraw', 'App\Http\Controllers\TransactionController@clientWithdraw');
Route::post('/user/deposit', 'App\Http\Controllers\TransactionController@clientDeposit');
Route::post('/user/transfer', 'App\Http\Controllers\TransactionController@clientTransfer');

// Account Action Routes (Admin)
Route::post('/admin/withdraw', 'App\Http\Controllers\TransactionController@adminWithdraw');
Route::post('/admin/deposit', 'App\Http\Controllers\TransactionController@adminDeposit');
Route::post('/admin/transfer', 'App\Http\Controllers\TransactionController@adminTransfer');
Route::post('/admin/create-bank-account', 'App\Http\Controllers\AccountController@createUserAccountByAdmin');
Route::put('/account/{id}/approve', 'App\Http\Controllers\AccountController@approveAccount')->name('account.approve');
Route::put('/account/{id}/block', 'App\Http\Controllers\AccountController@block')->name('user.block');
Route::put('/account/{id}/unblock', 'App\Http\Controllers\AccountController@unblock')->name('user.unblock');
