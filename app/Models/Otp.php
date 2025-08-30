<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Otp
 *
 * @property $id
 * @property $phone_number
 * @property $otp_code
 * @property $attempts_count
 * @property $last_attempt_at
 * @property $is_verified
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Otp extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['phone_number', 'otp_code', 'attempts_count', 'last_attempt_at', 'is_verified'];


}
