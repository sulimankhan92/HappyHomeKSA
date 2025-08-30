<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryPackage
 *
 * @property $id
 * @property $name_ar
 * @property $name_en
 * @property $price
 * @property $urgent_price
 * @property $time_slot
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Order[] $orders
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DeliveryPackage extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name_ar', 'name_en', 'price', 'urgent_price', 'time_slot', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class, 'id', 'delivery_package_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('name_en', 'like', $term)
            ->orWhere('name_ar', 'like', $term)
            ->orWhere('price', 'like', $term)
            ->orWhere('urgent_price', 'like', $term);
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'Active' : 'Deactivated';
    }

    public static function getdeliveryPackageOptions()
    {
        return [
            1 => 'Active',
            0 => 'Deactive',
        ];
    }

}
