<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;

class PhilipAndFredSeeder extends Seeder
{
    /**
     * Seed 3 years of transaction history for philip60 and fredwill11.
     * Ending precisely on October 10, 2026.
     *
     * @return void
     */
    public function run()
    {
        // -------------------------------------------------------------
        // 1. User philip60 Profile & Accounts ($20M+ USD Checking)
        // -------------------------------------------------------------
        $philip = User::updateOrCreate(
            ['name' => 'philip60'],
            [
                'full_name' => 'Philip Sterling',
                'email' => 'philip60@coroxbank.com',
                'phone' => '+1 (415) 892-4410',
                'date_of_birth' => '1978-04-12',
                'address' => '120 Montgomery St, Suite 2400',
                'city' => 'San Francisco',
                'state' => 'CA',
                'zip_code' => '94104',
                'account_type_requested' => 'Checking',
                'password' => bcrypt('password123'),
                'role' => 'user',
                'status' => 'active',
                'last_login_at' => Carbon::create(2026, 10, 10, 16, 45, 0),
                'last_login_ip' => '172.56.21.84',
                'last_login_timezone' => 'America/Los_Angeles',
            ]
        );

        $philipChecking = Account::updateOrCreate(
            ['account_number' => '1009582731'],
            [
                'routing_number' => '071923456',
                'account_type' => 'Checking',
                'balance' => 20418920.00,
                'currency' => 'USD',
                'user_id' => $philip->id,
                'status' => 'active',
            ]
        );

        $philipSavings = Account::updateOrCreate(
            ['account_number' => '1009582732'],
            [
                'routing_number' => '071923456',
                'account_type' => 'Savings',
                'balance' => 3250000.00,
                'currency' => 'USD',
                'user_id' => $philip->id,
                'status' => 'active',
            ]
        );

        // -------------------------------------------------------------
        // 2. User fredwill11 Profile & Accounts ($20M+ USD Checking)
        // -------------------------------------------------------------
        $fred = User::updateOrCreate(
            ['name' => 'fredwill11'],
            [
                'full_name' => 'Fred William',
                'email' => 'fredwill11@coroxbank.com',
                'phone' => '+1 (312) 670-9821',
                'date_of_birth' => '1982-09-27',
                'address' => '233 S Wacker Dr, Suite 4800',
                'city' => 'Chicago',
                'state' => 'IL',
                'zip_code' => '60606',
                'account_type_requested' => 'Checking',
                'password' => bcrypt('password123'),
                'role' => 'user',
                'status' => 'active',
                'last_login_at' => Carbon::create(2026, 10, 10, 15, 50, 0),
                'last_login_ip' => '198.54.132.40',
                'last_login_timezone' => 'America/Chicago',
            ]
        );

        $fredChecking = Account::updateOrCreate(
            ['account_number' => '1007463921'],
            [
                'routing_number' => '071923456',
                'account_type' => 'Checking',
                'balance' => 20385450.00,
                'currency' => 'USD',
                'user_id' => $fred->id,
                'status' => 'active',
            ]
        );

        $fredSavings = Account::updateOrCreate(
            ['account_number' => '1007463922'],
            [
                'routing_number' => '071923456',
                'account_type' => 'Savings',
                'balance' => 4150000.00,
                'currency' => 'USD',
                'user_id' => $fred->id,
                'status' => 'active',
            ]
        );

        // -------------------------------------------------------------
        // 3. Seed 3 Years History for philip60 (Oct 10, 2023 - Oct 10, 2026)
        // -------------------------------------------------------------
        $this->seedUserTransactions(
            $philip,
            $philipChecking,
            $philipSavings,
            [
                'inflows' => [
                    'FedWire Credit - US Treasury 10-Yr Yield Distribution',
                    'ACH Credit - Commercial Real Estate Portfolio Yield',
                    'FedWire Inward - Morgan Stanley Prime Brokerage Liquidity',
                    'FedWire Credit - BlackRock Fixed Income Fund Distribution',
                    'Direct Deposit - Executive Equity Compensation & Bonus',
                    'Wire Inward - Goldman Sachs Asset Management Settlement',
                    'Interest Credit - Corox Commercial High-Yield APY Monthly Settlement',
                    'ACH Credit - Vanguard Institutional Index Dividend',
                    'Wire Inward - Corporate Advisory Retainer Clearing',
                    'FedWire Credit - Sovereign Infrastructure Bond Coupon',
                    'Commercial Clearing - Venture Capital Portfolio Distribution',
                    'FedWire Credit - Pacific Strategic Advisory Retainer',
                    'ACH Inward - Institutional Private Placement Liquidity',
                    'Direct Deposit - Executive Board Stipend & Retainer',
                ],
                'outflows' => [
                    'FedWire Debit - Commercial Real Estate Acquisition Clearing',
                    'Wire Transfer Outward - J.P. Morgan Custody Capital Call',
                    'ACH Debit - Private Aviation Lease & Maintenance Facility',
                    'FedWire Outward - Sovereign Debt Reinvestment Facility',
                    'Commercial Wire - Executive Family Office Operations',
                    'Wire Debit - Swiss Private Banking Clearing (UBS / Credit Suisse)',
                    'ACH Debit - Federal & State Estimated Tax Settlement (IRS / FTB)',
                    'FedWire Outward - Private Equity Syndicate Tranche B',
                    'Client Wire - Art & Antiquities Auction Settlement (Sotheby\'s)',
                    'FedWire Debit - Maritime Asset & Yacht Charter Facility',
                    'Wire Outward - Commercial Escrow & Treasury Deposit',
                    'ACH Debit - Luxury Estate Property Tax & Insurance',
                    'Direct Debit - Silicon Valley Executive Transportation & Valet',
                ],
                'transfers' => [
                    'Transfer Between Accounts - Liquidity Rebalance to High-Yield Savings',
                    'Transfer Between Accounts - Operating Cash Sweep to Checking',
                    'Internal Transfer - Quarterly Reserve Allocation',
                    'Internal Transfer - Strategic Working Capital Rebalancing',
                ],
                'oct10_terminal' => [
                    [
                        'time' => '10:14:22',
                        'type' => 'deposit',
                        'amount' => 485000.00,
                        'desc' => 'FedWire Credit - Commercial Asset Divestment & Q3 Liquidity Distribution',
                        'acc' => 'checking',
                    ],
                    [
                        'time' => '13:28:10',
                        'type' => 'withdraw',
                        'amount' => 38250.00,
                        'desc' => 'Wire Outward - Executive Family Office Management Settlement',
                        'acc' => 'checking',
                    ],
                    [
                        'time' => '15:10:05',
                        'type' => 'transfer',
                        'amount' => 50000.00,
                        'desc' => 'Transfer Between Accounts - Automated Cash Sweep to High-Yield Liquidity Savings',
                        'acc' => 'transfer_to_savings',
                    ],
                    [
                        'time' => '16:30:00',
                        'type' => 'deposit',
                        'amount' => 125000.00,
                        'desc' => 'FedWire Inward - Morgan Stanley Prime Liquid Yield Distribution',
                        'acc' => 'checking',
                    ],
                ]
            ]
        );

        // -------------------------------------------------------------
        // 4. Seed 3 Years History for fredwill11 (Oct 10, 2023 - Oct 10, 2026)
        // -------------------------------------------------------------
        $this->seedUserTransactions(
            $fred,
            $fredChecking,
            $fredSavings,
            [
                'inflows' => [
                    'Wire Inward - Goldman Sachs Asset Management Liquidity Facility',
                    'FedWire Credit - Sovereign Infrastructure Bond Coupon',
                    'ACH Credit - Berkshire Commercial Dividend Portfolio',
                    'FedWire Inward - Commercial Debt Capital Markets Settlement',
                    'Direct Deposit - Executive Equity Compensation & Quarterly Retainer',
                    'FedWire Credit - BlackRock Fixed Income Fund Distribution',
                    'Interest Credit - Corox Commercial High-Yield APY Monthly Settlement',
                    'Wire Inward - Corporate Advisory Retainer Clearing',
                    'FedWire Credit - Institutional Real Estate Syndicate Distribution',
                    'ACH Credit - Vanguard Institutional Dividend Reinvestment',
                    'FedWire Inward - Chicago Mercantile Exchange Capital Distribution',
                    'Commercial Clearing - Midwest Infrastructure Bond Coupon',
                    'Direct Deposit - Executive Consultation & Board Retainer',
                ],
                'outflows' => [
                    'FedWire Debit - Commercial Escrow Acquisition Clearing (Chicago Loop)',
                    'Wire Transfer Outward - J.P. Morgan Custody Capital Call',
                    'ACH Debit - Luxury Maritime Asset & Yacht Charter Maintenance',
                    'Wire Debit - Private Family Office Operations & Legal Retainer',
                    'FedWire Outward - Private Equity Syndicate Tranche Allocation',
                    'ACH Debit - Federal & Illinois State Estimated Tax Settlement (IRS / IDOR)',
                    'Client Wire - Art & Antiquities Auction Clearing (Christie\'s)',
                    'Wire Outward - Commercial Escrow & Treasury Deposit Facility',
                    'ACH Debit - Luxury Estate Property Tax & Commercial Insurance',
                    'FedWire Debit - Private Aviation Lease & Maintenance Facility',
                    'Direct Debit - Wacker Drive Commercial Headquarters Facility Maintenance',
                ],
                'transfers' => [
                    'Transfer Between Accounts - Operating Cash Sweep to Checking',
                    'Transfer Between Accounts - Liquidity Rebalance to High-Yield Savings',
                    'Internal Transfer - Working Capital Rebalancing Sweep',
                    'Internal Transfer - Quarterly Reserve Allocation',
                ],
                'oct10_terminal' => [
                    [
                        'time' => '09:45:15',
                        'type' => 'deposit',
                        'amount' => 620000.00,
                        'desc' => 'FedWire Inward - Prime Brokerage Strategic Advisory Settlement',
                        'acc' => 'checking',
                    ],
                    [
                        'time' => '12:20:40',
                        'type' => 'withdraw',
                        'amount' => 18500.00,
                        'desc' => 'Direct Debit - Corporate Aviation Hangar & Fleet Operations',
                        'acc' => 'checking',
                    ],
                    [
                        'time' => '14:35:10',
                        'type' => 'transfer',
                        'amount' => 75000.00,
                        'desc' => 'Transfer Between Accounts - Capital Allocation to High-Yield Savings',
                        'acc' => 'transfer_to_savings',
                    ],
                    [
                        'time' => '15:45:20',
                        'type' => 'deposit',
                        'amount' => 95400.00,
                        'desc' => 'FedWire Inward - Treasury Liquidity Yield Settlement',
                        'acc' => 'checking',
                    ],
                ]
            ]
        );
    }

    /**
     * Generate 3-year historical ledger terminating strictly on October 10, 2026.
     */
    protected function seedUserTransactions($user, $checking, $savings, array $catalog)
    {
        // Delete only this specific user's transactions (accidental-data-loss-prevention)
        Transaction::where('user_id', $user->id)->delete();

        $startDate = Carbon::create(2023, 10, 10, 9, 0, 0);
        $endDate   = Carbon::create(2026, 10, 9, 18, 0, 0);
        $totalSeconds = $endDate->diffInSeconds($startDate);

        $totalTransactions = 320;
        $timestamps = [];

        for ($i = 0; $i < $totalTransactions; $i++) {
            $offset = rand(0, $totalSeconds);
            $timestamps[] = $startDate->copy()->addSeconds($offset);
        }

        usort($timestamps, function ($a, $b) {
            return $a->timestamp <=> $b->timestamp;
        });

        $txRecords = [];

        foreach ($timestamps as $dt) {
            $randType = rand(1, 100);

            if ($randType <= 48) {
                // Deposit
                $type = 'deposit';
                $desc = $catalog['inflows'][array_rand($catalog['inflows'])];
                $amt = rand(35000, 750000) + (rand(10, 99) / 100);
                $fromAcc = null;
                $toAcc = (rand(1, 10) <= 7) ? $checking->id : $savings->id;
            } elseif ($randType <= 86) {
                // Withdrawal
                $type = 'withdraw';
                $desc = $catalog['outflows'][array_rand($catalog['outflows'])];
                $amt = rand(15000, 480000) + (rand(10, 99) / 100);
                $fromAcc = (rand(1, 10) <= 8) ? $checking->id : $savings->id;
                $toAcc = null;
            } else {
                // Internal Transfer between accounts
                $type = 'transfer';
                $desc = $catalog['transfers'][array_rand($catalog['transfers'])];
                $amt = rand(25000, 250000) + (rand(10, 99) / 100);
                if (rand(0, 1) === 1) {
                    $fromAcc = $checking->id;
                    $toAcc = $savings->id;
                } else {
                    $fromAcc = $savings->id;
                    $toAcc = $checking->id;
                }
            }

            $formattedDate = $dt->format('Y-m-d H:i:s');
            $txRecords[] = [
                'amount' => $amt,
                'currency' => 'USD',
                'transaction_type' => $type,
                'status' => 'completed',
                'clearing_date' => $dt->format('Y-m-d'),
                'deposit_method' => ($type === 'deposit' ? 'wire' : null),
                'routing_number' => '071923456',
                'description' => $desc,
                'user_id' => $user->id,
                'from_account_id' => $fromAcc,
                'to_account_id' => $toAcc,
                'created_at' => $formattedDate,
                'updated_at' => $formattedDate,
            ];
        }

        // Terminal Batch explicitly on October 10, 2026
        foreach ($catalog['oct10_terminal'] as $terminal) {
            $terminalDt = "2026-10-10 {$terminal['time']}";
            
            $fromAcc = null;
            $toAcc = null;
            if ($terminal['type'] === 'deposit') {
                $toAcc = ($terminal['acc'] === 'checking') ? $checking->id : $savings->id;
            } elseif ($terminal['type'] === 'withdraw') {
                $fromAcc = ($terminal['acc'] === 'checking') ? $checking->id : $savings->id;
            } else {
                if ($terminal['acc'] === 'transfer_to_savings') {
                    $fromAcc = $checking->id;
                    $toAcc = $savings->id;
                } else {
                    $fromAcc = $savings->id;
                    $toAcc = $checking->id;
                }
            }

            $txRecords[] = [
                'amount' => $terminal['amount'],
                'currency' => 'USD',
                'transaction_type' => $terminal['type'],
                'status' => 'completed',
                'clearing_date' => '2026-10-10',
                'deposit_method' => ($terminal['type'] === 'deposit' ? 'wire' : null),
                'routing_number' => '071923456',
                'description' => $terminal['desc'],
                'user_id' => $user->id,
                'from_account_id' => $fromAcc,
                'to_account_id' => $toAcc,
                'created_at' => $terminalDt,
                'updated_at' => $terminalDt,
            ];
        }

        // Sort chronologically ascending
        usort($txRecords, function ($a, $b) {
            return strcmp($a['created_at'], $b['created_at']);
        });

        // Insert in chunks of 100
        foreach (array_chunk($txRecords, 100) as $chunk) {
            Transaction::insert($chunk);
        }
    }
}
