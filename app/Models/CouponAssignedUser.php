<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CouponAssignedUser
 *
 * @property $id
 * @property $coupon_id
 * @property $user_id
 * @property $assigned_by_user_id
 * @property $used_count
 * @property $is_active
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Coupon $coupon
 * @property User $created_by
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CouponAssignedUser extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['coupon_id', 'user_id', 'assigned_by_user_id', 'used_count', 'is_active'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coupon()
    {
        return $this->belongsTo(\App\Models\Coupon::class, 'coupon_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function created_by()
    {
        return $this->belongsTo(\App\Models\User::class, 'assigned_by_user_id', 'id');
    }

    public static function getIsActiveOptions()
    {
        return [
            0 => 'Inactive',
            1 => 'Active',
        ];
    }

}
