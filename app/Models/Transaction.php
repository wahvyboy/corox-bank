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
}

