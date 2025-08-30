<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{

    protected $fillable = [
        'user_id',
        'card_type',
        'card_number',
        'holder_name',
        'expiry_date',
        'cvv',
    ];
}
