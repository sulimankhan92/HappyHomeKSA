<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PaymentMethod
 *
 * @property $id
 * @property $user_id
 * @property $name_en
 * @property $name_ar
 * @property $description_en
 * @property $description_ar
 * @property $status
 * @property $web_view
 * @property $icon
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Order[] $orders
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PaymentMethod extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['user_id', 'name_en', 'name_ar', 'description_en', 'description_ar','web_view','icon', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class, 'id', 'payment_method_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('name_en', 'like', $term)
            ->orWhere('name_ar', 'like', $term)
            ->orWhere('description_en', 'like', $term)
            ->orWhere('description_ar', 'like', $term);
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'Active' : 'Deactivated';
    }

    public static function getStatusOptions()
    {
        return [
            0 => 'Active',
            1 => 'Deactivated',
        ];
    }
}
