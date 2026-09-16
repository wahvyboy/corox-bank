<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Create Admin User
        $admin = User::firstOrCreate(
            ['name' => 'admin'],
            [
                'password' => bcrypt('password123'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        // 2. Create Client User
        $client = User::firstOrCreate(
            ['name' => 'client'],
            [
                'password' => bcrypt('password123'),
                'role' => 'user',
                'status' => 'active',
            ]
        );

        // 3. Create Demo User (John Doe)
        $john = User::firstOrCreate(
            ['name' => 'john_doe'],
            [
                'password' => bcrypt('password123'),
                'role' => 'user',
                'status' => 'active',
            ]
        );

        // 4. Create USD Checking Account for Client
        $checkingAccount = Account::firstOrCreate(
            ['account_number' => '1002847591'],
            [
                'routing_number' => '026009593',
                'account_type' => 'Checking',
                'balance' => 24850.00,
                'currency' => 'USD',
                'user_id' => $client->id,
                'status' => 'active',
            ]
        );

        // 5. Create USD Savings Account for Client
        $savingsAccount = Account::firstOrCreate(
            ['account_number' => '1009384726'],
            [
                'routing_number' => '026009593',
                'account_type' => 'Savings',
                'balance' => 150000.00,
                'currency' => 'USD',
                'user_id' => $client->id,
                'status' => 'active',
            ]
        );

        // 6. Create USD Checking Account for John Doe
        $johnAccount = Account::firstOrCreate(
            ['account_number' => '1007788990'],
            [
                'routing_number' => '026009593',
                'account_type' => 'Checking',
                'balance' => 12500.00,
                'currency' => 'USD',
                'user_id' => $john->id,
                'status' => 'active',
            ]
        );

        // 7. Create Pending Account Request for Client
        Account::firstOrCreate(
            ['account_number' => '1004455667'],
            [
                'routing_number' => '026009593',
                'account_type' => 'Savings',
                'balance' => 0.00,
                'currency' => 'USD',
                'user_id' => $client->id,
                'status' => 'pending',
            ]
        );

        // 8. Seed Initial USD Transactions
        Transaction::firstOrCreate([
            'amount' => 5000.00,
            'transaction_type' => 'deposit',
            'routing_number' => '026009593',
            'description' => 'Initial Direct Deposit',
            'user_id' => $client->id,
            'to_account_id' => $checkingAccount->id,
        ]);

        Transaction::firstOrCreate([
            'amount' => 1200.00,
            'transaction_type' => 'transfer',
            'routing_number' => '026009593',
            'description' => 'Wire Transfer to John Doe',
            'user_id' => $client->id,
            'from_account_id' => $checkingAccount->id,
            'to_account_id' => $johnAccount->id,
        ]);

        Transaction::firstOrCreate([
            'amount' => 300.00,
            'transaction_type' => 'withdraw',
            'routing_number' => '026009593',
            'description' => 'ATM Cash Withdrawal',
            'user_id' => $client->id,
            'from_account_id' => $checkingAccount->id,
        ]);
    }
}
