<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CouponUser
 *
 * @property $id
 * @property $coupon_id
 * @property $user_id
 * @property $order_id
 * @property $used_count
 *
 * @property Coupon $coupon
 * @property Order $order
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class CouponUser extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['coupon_id', 'user_id', 'order_id', 'used_count'];


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
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class, 'order_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('coupon_id', 'like', $term);
    }

}
