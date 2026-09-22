<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
        'transaction_type',
        'status',
        'clearing_date',
        'deposit_method',
        'routing_number',
        'description',
        'check_front_image',
        'check_back_image',
        'check_number',
        'user_id',
        'from_account_id',
        'to_account_id',
    ];

    protected $casts = [
        'clearing_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromAccount()
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function toAccount()
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    /**
     * Resolve receiving financial institution by ABA routing transit number.
     */
    public static function resolveBankByRouting($routing)
    {
        $routing = trim((string) $routing);
        $directory = [
            '071923456' => 'Corox Bank (Internal Clearing)',
            // Bank of America (Wire & ACH Clearing)
            '026009593' => 'Bank of America, N.A. (Domestic Wire Clearing)',
            '121000358' => 'Bank of America, N.A. (California)',
            '054000030' => 'Bank of America, N.A. (North Carolina)',
            '111000025' => 'Bank of America, N.A. (Texas)',
            '021200339' => 'Bank of America, N.A. (New York)',
            '011900254' => 'Bank of America, N.A. (Massachusetts)',
            '063100277' => 'Bank of America, N.A. (Florida)',
            // Top US Commercial & Investment Banks
            '021000021' => 'JPMorgan Chase Bank, N.A. (New York)',
            '111000614' => 'JPMorgan Chase Bank, N.A. (Texas)',
            '071000013' => 'JPMorgan Chase Bank, N.A. (Midwest)',
            '121000248' => 'Wells Fargo Bank, N.A. (San Francisco)',
            '091000019' => 'Wells Fargo Bank, N.A. (Minneapolis)',
            '102000076' => 'Wells Fargo Bank, N.A. (Denver)',
            '021000089' => 'Citibank, N.A. (New York)',
            '221172186' => 'Citibank, N.A. (South Dakota)',
            '321171184' => 'Citibank, N.A. (Delaware)',
            '101205681' => 'Fidelity Brokerage Services LLC',
            '122105155' => 'Fidelity Investments (UMB Bank, N.A.)',
            '062000019' => 'Regions Bank, N.A.',
            '031000053' => 'PNC Bank, N.A.',
            '122000496' => 'U.S. Bank, N.A.',
            '061000104' => 'Truist Bank',
            '051405515' => 'Capital One Bank, N.A.',
            '011103093' => 'TD Bank, N.A.',
            '021000018' => 'The Bank of New York Mellon (BNY)',
            '021000128' => 'Goldman Sachs Bank USA',
            '021001088' => 'Morgan Stanley Private Bank, N.A.',
            '121136785' => 'Charles Schwab Bank, SSB',
        ];

        if (isset($directory[$routing])) {
            return $directory[$routing];
        }

        if (strlen($routing) >= 8) {
            $prefix = substr($routing, 0, 2);
            if (in_array($prefix, ['01', '02'])) return 'Commercial Clearing Bank (New York / East Coast)';
            if (in_array($prefix, ['03', '04'])) return 'Federal Reserve District 3/4 Member Bank';
            if ($prefix === '06') return 'Federal Reserve District 6 (Atlanta / Southeast)';
            if (in_array($prefix, ['07', '08'])) return 'Federal Reserve District 7/8 (Chicago / St. Louis)';
            if (in_array($prefix, ['09', '10'])) return 'Federal Reserve District 9/10 (Midwest / Central)';
            if (in_array($prefix, ['11', '12'])) return 'Pacific Clearing & Commercial Bank (West Coast)';
            return 'Verified Commercial Financial Institution (ABA: ' . $routing . ')';
        }

        return 'Corox Bank (Internal Clearing)';
    }

    /**
     * Get human-readable receiving financial institution name.
     */
    public function getReceivingBankAttribute()
    {
        return self::resolveBankByRouting($this->routing_number);
    }
}

