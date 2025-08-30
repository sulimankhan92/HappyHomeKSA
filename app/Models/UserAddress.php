<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'latitude',
        'longitude',
        'city',
        'type',
        'status',
        'is_default',
        'is_select',
    ];

    /**
     * Get the user associated with the address.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
