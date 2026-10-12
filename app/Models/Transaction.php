<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\CurrencyService;
use App\Services\BankDirectoryService;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
        'currency',
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
     * Resolve effective currency of this transaction.
     */
    public function getCurrencyAttribute($value)
    {
        if (!empty($value)) {
            return strtoupper($value);
        }
        if ($this->fromAccount && !empty($this->fromAccount->currency)) {
            return strtoupper($this->fromAccount->currency);
        }
        if ($this->toAccount && !empty($this->toAccount->currency)) {
            return strtoupper($this->toAccount->currency);
        }
        return 'USD';
    }

    /**
     * Get currency symbol ($, A$, €, £, etc.)
     */
    public function getCurrencySymbolAttribute()
    {
        return CurrencyService::symbol($this->currency);
    }

    /**
     * Get formatted amount with symbol.
     */
    public function getFormattedAmountAttribute()
    {
        return CurrencyService::format($this->amount, $this->currency);
    }

    /**
     * Resolve receiving financial institution by ABA routing, SWIFT/BIC, Sort Code, or BSB.
     */
    public static function resolveBankByRouting($routing)
    {
        $info = BankDirectoryService::lookup($routing);
        return $info['name'] ?? 'Corox Bank (Internal Clearing)';
    }

    /**
     * Get human-readable receiving financial institution name.
     */
    public function getReceivingBankAttribute()
    {
        return self::resolveBankByRouting($this->routing_number);
    }

    /**
     * Get detailed info about receiving institution.
     */
    public function getReceivingBankDetailsAttribute()
    {
        return BankDirectoryService::lookup($this->routing_number);
    }
}
