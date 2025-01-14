<?php

namespace Kogol1\RaiffeisenbankPremiumApiLaravel\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'reference',
        'bank_transaction_code',
        'amount',
        'currency',
        'payment_date',
        'origin_account_holder_name',
        'origin_account_number',
        'destination_account_number',
        'message',
        'variable_symbol',
        'constant_symbol',
        'specific_symbol',
        'origin_bank_code',
        'destination_bank_code',
    ];

    protected function casts(): array
    {
        return [
            'payment_date' => 'datetime',
        ];
    }
}
