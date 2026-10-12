<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ConvertKylieTransactionsToAud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 1. Ensure currency column exists on transactions table
        if (Schema::hasTable('transactions') && !Schema::hasColumn('transactions', 'currency')) {
            Schema::table('transactions', function ($table) {
                $table->string('currency', 10)->default('USD')->after('amount');
            });
        }

        // 2. Find Kylie user
        $kylie = DB::table('users')
            ->where('name', 'kylie')
            ->orWhere('name', 'kylieAnn003')
            ->orWhere('email', 'like', '%kylie.anne%')
            ->first();

        if ($kylie) {
            // Update Kylie profile to Sydney, Australia
            DB::table('users')->where('id', $kylie->id)->update([
                'phone' => '+61 2 9223 8800',
                'address' => 'Level 42, Governor Phillip Tower, 1 Farrer Place',
                'city' => 'Sydney',
                'state' => 'NSW',
                'zip_code' => '2000',
                'last_login_ip' => '101.167.240.12',
                'last_login_timezone' => 'Australia/Sydney',
                'updated_at' => now(),
            ]);

            // Update all accounts belonging to Kylie to AUD with BSB 082001
            DB::table('accounts')->where('user_id', $kylie->id)->update([
                'currency' => 'AUD',
                'routing_number' => '082001',
                'updated_at' => now(),
            ]);

            // Update all transactions for Kylie to AUD and BSB 082001 (strictly for Kylie only)
            DB::table('transactions')->where('user_id', $kylie->id)->update([
                'currency' => 'AUD',
                'routing_number' => '082001',
            ]);

            // Update transaction descriptions for Kylie to Sydney/Australian financial terms
            $replacements = [
                'Starbucks Reserve & Roastery - Point of Sale' => 'Single O Surry Hills - Point of Sale',
                'Uber Black VIP Executive Transportation' => 'Uber Black Sydney CBD Executive Transportation',
                'Domestic FedWire Incoming Settlement Clearing Fee' => 'NPP Instant Inward Settlement Clearing Fee',
                'Nobu Los Angeles - Executive Business Luncheon' => 'Quay Restaurant Sydney Harbour - Executive Business Luncheon',
                'Chevron Executive Fuel & Transportation' => 'Ampol Executive Fuel & Fleet Facility',
                'Equinox Executive Sports Club Valet & Spa Service' => 'The Australian Club Sydney - Executive Lounge & Valet',
                'Courier Express - Legal & Confidential Document Courier' => 'StarTrack Express - Confidential Legal Document Courier',
                'FedWire Inward - Corporate Advisory Retainer & Q3 Settlement (Goldman Sachs)' => 'RTGS Inward - Macquarie Capital Corporate Advisory Retainer & Q3 Settlement (Macquarie Bank)',
                'FedWire Inward - Institutional Liquidity & Capital Distribution (Morgan Stanley)' => 'NPP Inward - Institutional Liquidity & Capital Distribution (Commonwealth Bank of Australia)',
                'FedWire Credit - BlackRock Fixed Income Fund Distribution' => 'RTGS Credit - BlackRock Australian Fixed Interest Fund Distribution',
                'Portfolio Yield - Vanguard Institutional Index Fund Dividend' => 'Portfolio Yield - Vanguard Australian Shares Index ETF (VAS) Distribution',
                'Capital Distribution - Sequoia Capital Growth Tranche Distribution' => 'Capital Distribution - Square Peg Capital Growth Tranche Distribution',
                'Portfolio Yield - Morgan Stanley Prime Liquid Yield Distribution' => 'Portfolio Yield - Macquarie Prime Liquid Yield Distribution',
                'FedWire Credit - Sovereign Infrastructure Bond Coupon' => 'RTGS Credit - NSW Treasury Corporation (TCorp) Bond Coupon',
            ];

            foreach ($replacements as $oldDesc => $newDesc) {
                DB::table('transactions')
                    ->where('user_id', $kylie->id)
                    ->where('description', 'like', "%{$oldDesc}%")
                    ->update(['description' => DB::raw("REPLACE(description, " . DB::getPdo()->quote($oldDesc) . ", " . DB::getPdo()->quote($newDesc) . ")")]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Reversal does not revert individual user data
    }
}
