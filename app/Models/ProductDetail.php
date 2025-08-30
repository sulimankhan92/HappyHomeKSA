<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductDetail
 *
 * @property $id
 * @property $product_variant_id
 * @property $product_packaging_id
 * @property $created_by
 * @property $price
 * @property $old_price
 * @property $quantity_to_show_alerts
 * @property $status
 * @property $quantity_sale
 * @property $quantity_instock
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property ProductPacking $productPacking
 * @property ProductVariant $productVariant
 * @property OrderItem[] $orderItems
 * @property ProductPromotion[] $productPromotions
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductDetail extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['product_variant_id', 'product_packaging_id', 'created_by', 'price','old_price', 'quantity_instock', 'quantity_sale', 'quantity_to_show_alerts', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productPacking()
    {
        return $this->belongsTo(\App\Models\ProductPacking::class, 'product_packaging_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productVariant()
    {
        return $this->belongsTo(\App\Models\ProductVariant::class, 'product_variant_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'id', 'product_detail_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productPromotions()
    {
        return $this->hasMany(\App\Models\ProductPromotion::class, 'id', 'product_details_id');
    }

    public static function getStatusOptions()
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ];
    }
}
