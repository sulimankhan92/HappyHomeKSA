<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Coupon
 *
 * @property $id
 * @property $created_by
 * @property $code
 * @property $title_en
 * @property $title_ar
 * @property $description_en
 * @property $description_ar
 * @property $coupon_use_counts
 * @property $coupon_category
 * @property $type
 * @property $is_for_all_users
 * @property $minimum_order_amount
 * @property $amount
 * @property $is_active
 * @property $start_date
 * @property $end_date
 * @property $percentage
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property CouponAssignedUser[] $couponAssignedUsers
 * @property CouponUser[] $couponUsers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Coupon extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['created_by', 'code', 'title_en', 'title_ar', 'description_en', 'description_ar', 'coupon_use_counts', 'coupon_category', 'type', 'is_for_all_users', 'minimum_order_amount', 'amount', 'is_active', 'start_date', 'end_date','percentage'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function couponAssignedUsers()
    {
        return $this->hasMany(\App\Models\CouponAssignedUser::class, 'id', 'coupon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function couponUsers()
    {
        return $this->hasMany(\App\Models\CouponUser::class, 'id', 'coupon_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('code', 'like', $term)
            ->orWhere('title_en', 'like', $term)
            ->orWhere('title_ar', 'like', $term)
            ->orWhere('description_en', 'like', $term)
            ->orWhere('description_ar', 'like', $term);
    }

    public static function getCouponCategory()
    {
        return [
            'GLOBAL' => 'Global',
            'ORDER' => 'Order',
            'SHIPPING' => 'Shipping',
            'REFERRAL' => 'Referral',
            'EVENT' => 'Event',
            'FIRST_TIME_ORDER' => 'First Time Order',
        ];
    }

    public static function getCouponType()
    {
        return [
            'PERCENTAGE' => 'Percentage',
            'FIXED_AMOUNT' => 'Fixed Amount',
        ];
    }


    public function getIsActiveTextAttribute()
    {
        return $this->is_active ? 'Active' : 'Deactive';
    }

    public static function getIsActiveOptions()
    {
        return [
            0 => 'Deactive',
            1 => 'Active',
            2 => 'Coming Soon',
        ];
    }

    public static function getCouponUsageUsersOptions()
    {
        return [
            0 => 'True',
            1 => 'False',
        ];
    }

}
