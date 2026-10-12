<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\CurrencyService;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = [
        'account_number',
        'routing_number',
        'account_type',
        'balance',
        'currency',
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get currency symbol ($, A$, €, £, etc.)
     */
    public function getCurrencySymbolAttribute()
    {
        return CurrencyService::symbol($this->currency ?? 'USD');
    }

    /**
     * Get currency name (e.g. Australian Dollar)
     */
    public function getCurrencyNameAttribute()
    {
        return CurrencyService::name($this->currency ?? 'USD');
    }

    /**
     * Get formatted balance with symbol
     */
    public function getFormattedBalanceAttribute()
    {
        return CurrencyService::format($this->balance ?? 0, $this->currency ?? 'USD');
    }
}