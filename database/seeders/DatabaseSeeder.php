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

        // 9. Create Jack Whigham Profile ($43,890,870.00 USD)
        $jack = User::updateOrCreate(
            ['name' => 'jack'],
            [
                'full_name' => 'Jack Whigham',
                'email' => 'jack.whigham@coroxbank.com',
                'phone' => '+1 (212) 849-2041',
                'date_of_birth' => '1975-06-14',
                'address' => '740 Park Avenue, Penthouse 12A',
                'city' => 'New York',
                'state' => 'NY',
                'zip_code' => '10021',
                'account_type_requested' => 'Checking',
                'password' => bcrypt('password123'),
                'role' => 'user',
                'status' => 'active',
            ]
        );

        $jackChecking = Account::updateOrCreate(
            ['account_number' => '8820391456'],
            [
                'routing_number' => '026009593',
                'account_type' => 'Checking',
                'balance' => 30000000.00,
                'currency' => 'USD',
                'user_id' => $jack->id,
                'status' => 'active',
            ]
        );

        $jackSavings = Account::updateOrCreate(
            ['account_number' => '8820391457'],
            [
                'routing_number' => '026009593',
                'account_type' => 'Savings',
                'balance' => 13890870.00,
                'currency' => 'USD',
                'user_id' => $jack->id,
                'status' => 'active',
            ]
        );

        // Seed 720 Historical Transactions ending Sept 18, 2023 (3 years ago)
        if (Transaction::where('user_id', $jack->id)->count() < 700) {
            $depositDescriptions = [
                'FedWire Credit - US Treasury 10-Yr Yield Distribution',
                'ACH Credit - Berkshire Commercial Dividend Portfolio',
                'FedWire Inward - Morgan Stanley Prime Brokerage Liquidity',
                'FedWire Credit - BlackRock Fixed Income Fund Distribution',
                'Direct Deposit - Executive Equity Compensation & Bonus',
                'Wire Inward - Goldman Sachs Asset Management Settlement',
                'Interest Credit - Corox Commercial High-Yield APY Settlement',
                'FedWire Credit - Commercial Real Estate Portfolio Yield',
                'ACH Credit - Vanguard Institutional Index Dividend',
                'Wire Inward - Corporate Advisory Retainer Clearing',
                'FedWire Credit - Sovereign Infrastructure Bond Coupon',
                'Commercial Clearing - Venture Capital Portfolio Distribution',
            ];

            $withdrawDescriptions = [
                'FedWire Debit - Commercial Real Estate Acquisition Clearing',
                'Wire Transfer Outward - J.P. Morgan Custody Capital Call',
                'ACH Debit - Private Aviation Lease & Maintenance Facility',
                'FedWire Outward - Sovereign Debt Reinvestment Facility',
                'Commercial Wire - Executive Family Office Operations',
                'Wire Debit - Swiss Private Banking Clearing (Credit Suisse / UBS)',
                'ACH Debit - Federal & State Estimated Tax Settlement (IRS)',
                'FedWire Outward - Private Equity Syndicate Tranche B',
                'Client Wire - Art & Antiquities Auction Settlement (Sotheby\'s)',
                'FedWire Debit - Maritime Asset & Yacht Charter Facility',
                'Wire Outward - Commercial Escrow & Treasury Deposit',
                'ACH Debit - Luxury Estate Property Tax & Insurance',
            ];

            $transferDescriptions = [
                'Transfer Between Accounts - Liquidity Rebalance to High-Yield Savings',
                'Transfer Between Accounts - Operating Cash Sweep to Checking',
                'Internal Transfer - Quarterly Reserve Allocation',
                'Internal Transfer - Working Capital Rebalancing',
            ];

            $startDate = \Carbon\Carbon::create(2020, 1, 15, 9, 0, 0);
            $endDate   = \Carbon\Carbon::create(2023, 9, 18, 15, 45, 0);
            $totalSeconds = $endDate->diffInSeconds($startDate);

            $totalTransactions = 720;
            $transactionsData = [];

            $timestamps = [];
            for ($i = 0; $i < $totalTransactions; $i++) {
                if ($i === $totalTransactions - 1) {
                    $timestamps[] = $endDate->copy();
                } else {
                    $offset = rand(0, $totalSeconds - 86400);
                    $timestamps[] = $startDate->copy()->addSeconds($offset);
                }
            }
            usort($timestamps, function ($a, $b) {
                return $a->timestamp <=> $b->timestamp;
            });

            foreach ($timestamps as $txTime) {
                $randType = rand(1, 100);

                if ($randType <= 45) {
                    $type = 'deposit';
                    $desc = $depositDescriptions[array_rand($depositDescriptions)];
                    $amount = rand(25000, 1250000) + (rand(10, 99) / 100);
                    $fromAcc = null;
                    $toAcc = (rand(1, 10) <= 7) ? $jackChecking->id : $jackSavings->id;
                } elseif ($randType <= 85) {
                    $type = 'withdraw';
                    $desc = $withdrawDescriptions[array_rand($withdrawDescriptions)];
                    $amount = rand(15000, 850000) + (rand(10, 99) / 100);
                    $fromAcc = (rand(1, 10) <= 8) ? $jackChecking->id : $jackSavings->id;
                    $toAcc = null;
                } else {
                    $type = 'transfer';
                    $desc = $transferDescriptions[array_rand($transferDescriptions)];
                    $amount = rand(50000, 2000000) + (rand(10, 99) / 100);
                    if (rand(0, 1) === 1) {
                        $fromAcc = $jackChecking->id;
                        $toAcc = $jackSavings->id;
                    } else {
                        $fromAcc = $jackSavings->id;
                        $toAcc = $jackChecking->id;
                    }
                }

                $formattedDate = $txTime->format('Y-m-d H:i:s');

                $transactionsData[] = [
                    'amount' => $amount,
                    'transaction_type' => $type,
                    'routing_number' => '026009593',
                    'description' => $desc,
                    'user_id' => $jack->id,
                    'from_account_id' => $fromAcc,
                    'to_account_id' => $toAcc,
                    'created_at' => $formattedDate,
                    'updated_at' => $formattedDate,
                ];
            }

            foreach (array_chunk($transactionsData, 100) as $chunk) {
                Transaction::insert($chunk);
            }
        }
    }
}
