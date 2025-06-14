<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'user_id', 'provider', 'provider_id',
        'card_brand', 'card_last4', 'card_exp_month', 'card_exp_year',
        'is_default',
    ];
}
