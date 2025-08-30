<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseItem
 *
 * @property $id
 * @property $purchase_id
 * @property $product_variant_id
 * @property $quantity
 * @property $unit_price
 * @property $expiry_date
 * @property $purchase_price
 * @property $sale_price
 * @property $item_total
 * @property $created_at
 * @property $updated_at
 * @property $old_expiry_date
 * @property $old_qty
 *
 * @property ProductVariant $productVariant
 * @property Purchase $purchase
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PurchaseItem extends Model
{
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['purchase_id', 'product_variant_id', 'quantity', 'unit_price', 'expiry_date','purchase_price','sale_price','item_total','old_qty','old_expiry_date'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function productVariant()
    {
        return $this->belongsTo(\App\Models\ProductVariant::class, 'product_variant_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase()
    {
        return $this->belongsTo(\App\Models\Purchase::class, 'purchase_id', 'id');
    }

}
