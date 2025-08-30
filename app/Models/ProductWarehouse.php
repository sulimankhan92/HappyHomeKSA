<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductWarehouse
 *
 * @property $id
 * @property $created_by
 * @property $name_en
 * @property $name_ar
 * @property $address
 * @property $phone_number
 * @property $location_link
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Product[] $products
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductWarehouse extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['created_by', 'name_en', 'name_ar', 'address', 'phone_number', 'location_link', 'status'];


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
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'id', 'product_warehouse_id');
    }
    
}
