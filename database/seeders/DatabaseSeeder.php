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
                'routing_number' => '071923456',
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
                'routing_number' => '071923456',
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
                'routing_number' => '071923456',
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
                'routing_number' => '071923456',
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
            'currency' => 'USD',
            'transaction_type' => 'deposit',
            'routing_number' => '071923456',
            'description' => 'Initial Direct Deposit',
            'user_id' => $client->id,
            'to_account_id' => $checkingAccount->id,
        ]);

        Transaction::firstOrCreate([
            'amount' => 1200.00,
            'currency' => 'USD',
            'transaction_type' => 'transfer',
            'routing_number' => '071923456',
            'description' => 'Wire Transfer to John Doe',
            'user_id' => $client->id,
            'from_account_id' => $checkingAccount->id,
            'to_account_id' => $johnAccount->id,
        ]);

        Transaction::firstOrCreate([
            'amount' => 300.00,
            'currency' => 'USD',
            'transaction_type' => 'withdraw',
            'routing_number' => '071923456',
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
                'routing_number' => '071923456',
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
                'routing_number' => '071923456',
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
                    'currency' => 'USD',
                    'transaction_type' => $type,
                    'routing_number' => '071923456',
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

        // 10. Create Kylie Anne Profile ($29,567,090.00 AUD across 3 accounts - Fully Localized to Australia)
        $kylie = User::where('name', 'kylie')->orWhere('name', 'kylieAnn003')->first();
        $kylieData = [
            'name' => 'kylie',
            'full_name' => 'Kylie Anne',
            'email' => 'kylie.anne@coroxbank.com',
            'phone' => '+61 2 9223 8800',
            'date_of_birth' => '1988-04-22',
            'address' => 'Level 42, Governor Phillip Tower, 1 Farrer Place',
            'city' => 'Sydney',
            'state' => 'NSW',
            'zip_code' => '2000',
            'account_type_requested' => 'Checking',
            'password' => bcrypt('gue14@'),
            'role' => 'user',
            'status' => 'active',
            'last_login_at' => \Carbon\Carbon::create(2026, 10, 1, 17, 45, 0),
            'last_login_ip' => '101.167.240.12',
            'last_login_timezone' => 'Australia/Sydney',
        ];

        if ($kylie) {
            $kylie->update($kylieData);
        } else {
            $kylie = User::create($kylieData);
        }

        $kylieChecking = Account::updateOrCreate(
            ['account_number' => '1008492019'],
            [
                'routing_number' => '082001',
                'account_type' => 'Checking',
                'balance' => 4567090.00,
                'currency' => 'AUD',
                'user_id' => $kylie->id,
                'status' => 'active',
            ]
        );

        $kylieSavings = Account::updateOrCreate(
            ['account_number' => '1008492020'],
            [
                'routing_number' => '082001',
                'account_type' => 'Savings',
                'balance' => 10000000.00,
                'currency' => 'AUD',
                'user_id' => $kylie->id,
                'status' => 'active',
            ]
        );

        $kylieInvestment = Account::updateOrCreate(
            ['account_number' => '1008492021'],
            [
                'routing_number' => '082001',
                'account_type' => 'Investment',
                'balance' => 15000000.00,
                'currency' => 'AUD',
                'user_id' => $kylie->id,
                'status' => 'active',
            ]
        );

        // Seed Kylie Anne Transaction Ledger (From 2022 through Oct 1, 2026 in AUD)
        if (Transaction::where('user_id', $kylie->id)->count() < 300 || Transaction::where('user_id', $kylie->id)->where('currency', '!=', 'AUD')->exists()) {
            Transaction::where('user_id', $kylie->id)->delete();

            $kylieCheckingCorporateInflows = [
                'NPP Instant Inward - Institutional Client Advisory Retainer - Apex Global Australia',
                'RTGS Credit - Corporate Board Executive Equity Incentive & Performance Bonus (ASX:BHP)',
                'RTGS Inward - Strategic Merger Advisory Fee Settlement - Macquarie Capital',
                'Commercial Inward - Intellectual Property Licensing Clearing - Horizon Media Australia',
                'NPP Fast Settlement - Corporate Treasury Retainer Fee Settlement',
                'RTGS Inward - Private Placement Consulting Settlement (Sydney CBD)',
                'Osko Inward - Enterprise Advisory Retainer Clearing',
                'RTGS Credit - Global Media Licensing Royalty Revenue',
            ];

            $kylieCheckingPersonalInflows = [
                'NPP Fast Credit - Family Office Capital Distribution (Sydney Trust)',
                'Direct Deposit - Executive Consultation & Media Royalties',
                'RTGS Credit - Private Wealth Quarterly Distribution',
                'NPP Inward - Real Estate Syndication Liquidity Payout (Barangaroo)',
            ];

            $kylieCheckingCorporateOutflows = [
                'NPP Fast Outward - Australian Taxation Office (ATO) Corporate BAS & Income Tax',
                'Direct Debit - Sydney CBD Commercial Headquarters Lease & Facility Maintenance',
                'RTGS Outward - Corporate Legal Counsel Retainer (King & Wood Mallesons)',
                'NPP Debit - Executive Staff Payroll & Superannuation Facility',
                'RTGS Outward - PwC Australia Audit & Accounting Settlement',
                'RTGS Outward - Corporate Treasury Asset Escrow Deposit',
            ];

            $kylieCheckingPersonalOutflows = [
                'Direct Debit - Sydney Harbour Aviation & Helicopter Charter Facility',
                'Debit Card POS - Crown Sydney Luxury Concierge & Hotel',
                'RTGS Debit - Contemporary Art & Sculpture Auction Clearing (Deutscher and Hackett)',
                'Direct Debit - Point Piper Residential Estate Council Rates & Insurance',
                'RTGS Outward - European Travel & Private Villa Escrow',
                'Debit Card POS - Bennelong Restaurant Sydney Opera House - Executive Dining',
            ];

            $kylieSavingsInflows = [
                'Interest Credit - Corox Commercial High-Yield APY Monthly Settlement (AUD)',
                'Transfer Between Accounts - Operating Cash Sweep from Checking to Savings',
                'RTGS Inward - Australian Commonwealth Government Bond 10-Yr Coupon Yield',
                'NPP Credit - Fixed Income Portfolio Reserve Settlement',
            ];

            $kylieInvestmentInflows = [
                'Portfolio Yield - Vanguard Australian Shares Index ETF (VAS) Distribution',
                'RTGS Credit - BlackRock Australian Fixed Interest Fund Distribution',
                'Capital Distribution - Square Peg Capital Growth Tranche Distribution',
                'Transfer Between Accounts - Strategic Capital Inward from Savings',
                'Portfolio Yield - Macquarie Prime Liquid Yield Distribution',
                'RTGS Credit - NSW Treasury Corporation (TCorp) Bond Coupon',
            ];

            $kylieTxs = [];

            // 1. Generate multi-year historical transactions (2022-01-15 to 2026-09-25)
            $histStartDate = \Carbon\Carbon::create(2022, 1, 15, 9, 0, 0);
            $histEndDate   = \Carbon\Carbon::create(2026, 9, 25, 16, 30, 0);
            $totalSecs = $histEndDate->diffInSeconds($histStartDate);

            $numHistorical = 360;
            $histTimestamps = [];
            for ($i = 0; $i < $numHistorical; $i++) {
                $offset = rand(0, $totalSecs);
                $histTimestamps[] = $histStartDate->copy()->addSeconds($offset);
            }
            usort($histTimestamps, function ($a, $b) {
                return $a->timestamp <=> $b->timestamp;
            });

            foreach ($histTimestamps as $dt) {
                $categoryRoll = rand(1, 100);

                if ($categoryRoll <= 55) {
                    // Checking Account Transactions (Corporate & Personal Inflows/Outflows)
                    $subRoll = rand(1, 100);
                    if ($subRoll <= 35) {
                        // Corporate Inflow
                        $type = 'deposit';
                        $desc = $kylieCheckingCorporateInflows[array_rand($kylieCheckingCorporateInflows)];
                        $amt = rand(120000, 780000) + (rand(10, 99) / 100);
                        $fromAcc = null;
                        $toAcc = $kylieChecking->id;
                    } elseif ($subRoll <= 55) {
                        // Personal Inflow
                        $type = 'deposit';
                        $desc = $kylieCheckingPersonalInflows[array_rand($kylieCheckingPersonalInflows)];
                        $amt = rand(35000, 220000) + (rand(10, 99) / 100);
                        $fromAcc = null;
                        $toAcc = $kylieChecking->id;
                    } elseif ($subRoll <= 80) {
                        // Corporate Outflow
                        $type = 'withdraw';
                        $desc = $kylieCheckingCorporateOutflows[array_rand($kylieCheckingCorporateOutflows)];
                        $amt = rand(25000, 320000) + (rand(10, 99) / 100);
                        $fromAcc = $kylieChecking->id;
                        $toAcc = null;
                    } else {
                        // Personal Outflow
                        $type = 'withdraw';
                        $desc = $kylieCheckingPersonalOutflows[array_rand($kylieCheckingPersonalOutflows)];
                        $amt = rand(1200, 48000) + (rand(10, 99) / 100);
                        $fromAcc = $kylieChecking->id;
                        $toAcc = null;
                    }
                } elseif ($categoryRoll <= 78) {
                    // Savings Account (High Inflows, Outflows solely between accounts)
                    $subRoll = rand(1, 100);
                    if ($subRoll <= 80) {
                        // Inflow
                        $type = 'deposit';
                        $desc = $kylieSavingsInflows[array_rand($kylieSavingsInflows)];
                        $amt = rand(32000, 480000) + (rand(10, 99) / 100);
                        $fromAcc = null;
                        $toAcc = $kylieSavings->id;
                    } else {
                        // Internal Outflow strictly to Checking or Investment
                        $type = 'transfer';
                        if (rand(0, 1) === 1) {
                            $desc = 'Transfer Between Accounts - Operating Cash Sweep to Checking';
                            $fromAcc = $kylieSavings->id;
                            $toAcc = $kylieChecking->id;
                        } else {
                            $desc = 'Transfer Between Accounts - Capital Allocation to Private Wealth Portfolio';
                            $fromAcc = $kylieSavings->id;
                            $toAcc = $kylieInvestment->id;
                        }
                        $amt = rand(50000, 350000) + (rand(10, 99) / 100);
                    }
                } else {
                    // Investment Account (High Inflows, Outflows solely between accounts)
                    $subRoll = rand(1, 100);
                    if ($subRoll <= 82) {
                        // Inflow
                        $type = 'deposit';
                        $desc = $kylieInvestmentInflows[array_rand($kylieInvestmentInflows)];
                        $amt = rand(75000, 650000) + (rand(10, 99) / 100);
                        $fromAcc = null;
                        $toAcc = $kylieInvestment->id;
                    } else {
                        // Internal Outflow strictly between accounts
                        $type = 'transfer';
                        if (rand(0, 1) === 1) {
                            $desc = 'Transfer Between Accounts - Portfolio Rebalancing Sweep to High-Yield Savings';
                            $fromAcc = $kylieInvestment->id;
                            $toAcc = $kylieSavings->id;
                        } else {
                            $desc = 'Transfer Between Accounts - Quarterly Portfolio Distribution to Checking';
                            $fromAcc = $kylieInvestment->id;
                            $toAcc = $kylieChecking->id;
                        }
                        $amt = rand(100000, 500000) + (rand(10, 99) / 100);
                    }
                }

                $formattedDate = $dt->format('Y-m-d H:i:s');
                $kylieTxs[] = [
                    'amount' => $amt,
                    'currency' => 'AUD',
                    'transaction_type' => $type,
                    'status' => 'completed',
                    'clearing_date' => $dt->format('Y-m-d'),
                    'deposit_method' => ($type === 'deposit' ? 'wire' : null),
                    'routing_number' => '082001',
                    'description' => $desc,
                    'user_id' => $kylie->id,
                    'from_account_id' => $fromAcc,
                    'to_account_id' => $toAcc,
                    'created_at' => $formattedDate,
                    'updated_at' => $formattedDate,
                ];
            }

            // 2. Sept 26, 2026 Incoming Transaction of $3,437 AUD
            $kylieTxs[] = [
                'amount' => 3437.00,
                'currency' => 'AUD',
                'transaction_type' => 'deposit',
                'status' => 'completed',
                'clearing_date' => '2026-09-26',
                'deposit_method' => 'wire',
                'routing_number' => '082001',
                'description' => 'NPP Instant Inward Settlement - Institutional Retainer Ref #AU-92847',
                'user_id' => $kylie->id,
                'from_account_id' => null,
                'to_account_id' => $kylieChecking->id,
                'created_at' => '2026-09-26 11:24:18',
                'updated_at' => '2026-09-26 11:24:18',
            ];

            // 3. Add October 1, 2026 Transactions (Sydney Localized Anchor Batch)
            $oct1Date = '2026-10-01';

            // Outgoing Transactions on Oct 1, 2026 (AUD)
            $tinyOutgoings = [
                ['time' => '08:14:22', 'amt' => 15.50, 'desc' => 'Single O Surry Hills - Point of Sale'],
                ['time' => '09:30:10', 'amt' => 48.25, 'desc' => 'Uber Black Sydney CBD Executive Transportation'],
                ['time' => '10:16:05', 'amt' => 25.00, 'desc' => 'NPP Instant Inward Settlement Clearing Fee'],
                ['time' => '11:20:44', 'amt' => 84.99, 'desc' => 'Bloomberg Professional Terminal Mobile Subscription'],
                ['time' => '12:45:19', 'amt' => 320.00, 'desc' => 'Quay Restaurant Sydney Harbour - Executive Business Luncheon'],
                ['time' => '13:43:00', 'amt' => 25.00, 'desc' => 'NPP Instant Inward Settlement Clearing Fee'],
                ['time' => '14:10:33', 'amt' => 18.75, 'desc' => 'Apple Services / iCloud+ 2TB Executive Storage'],
                ['time' => '16:15:50', 'amt' => 65.40, 'desc' => 'Ampol Executive Fuel & Fleet Facility'],
                ['time' => '17:30:12', 'amt' => 125.00, 'desc' => 'The Australian Club Sydney - Executive Lounge & Valet'],
                ['time' => '18:10:45', 'amt' => 95.00, 'desc' => 'StarTrack Express - Confidential Legal Document Courier'],
            ];

            foreach ($tinyOutgoings as $out) {
                $txDatetime = "{$oct1Date} {$out['time']}";
                $kylieTxs[] = [
                    'amount' => $out['amt'],
                    'currency' => 'AUD',
                    'transaction_type' => 'withdraw',
                    'status' => 'completed',
                    'clearing_date' => $oct1Date,
                    'deposit_method' => null,
                    'routing_number' => '082001',
                    'description' => $out['desc'],
                    'user_id' => $kylie->id,
                    'from_account_id' => $kylieChecking->id,
                    'to_account_id' => null,
                    'created_at' => $txDatetime,
                    'updated_at' => $txDatetime,
                ];
            }

            // Inflows on Oct 1, 2026: $403,700.00 and $890,000.00 (AUD)
            $kylieTxs[] = [
                'amount' => 403700.00,
                'currency' => 'AUD',
                'transaction_type' => 'deposit',
                'status' => 'completed',
                'clearing_date' => $oct1Date,
                'deposit_method' => 'wire',
                'routing_number' => '082001',
                'description' => 'RTGS Inward - Macquarie Capital Corporate Advisory Retainer & Q3 Settlement (Macquarie Bank)',
                'user_id' => $kylie->id,
                'from_account_id' => null,
                'to_account_id' => $kylieChecking->id,
                'created_at' => "{$oct1Date} 10:15:32",
                'updated_at' => "{$oct1Date} 10:15:32",
            ];

            $kylieTxs[] = [
                'amount' => 890000.00,
                'currency' => 'AUD',
                'transaction_type' => 'deposit',
                'status' => 'completed',
                'clearing_date' => $oct1Date,
                'deposit_method' => 'wire',
                'routing_number' => '082001',
                'description' => 'NPP Inward - Institutional Liquidity & Capital Distribution (Commonwealth Bank of Australia)',
                'user_id' => $kylie->id,
                'from_account_id' => null,
                'to_account_id' => $kylieChecking->id,
                'created_at' => "{$oct1Date} 13:42:18",
                'updated_at' => "{$oct1Date} 13:42:18",
            ];

            // Sort all transactions by date ascending before insertion
            usort($kylieTxs, function ($a, $b) {
                return strcmp($a['created_at'], $b['created_at']);
            });

            foreach (array_chunk($kylieTxs, 100) as $chunk) {
                Transaction::insert($chunk);
            }
        }
    }
}
