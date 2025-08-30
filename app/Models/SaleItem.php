<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SaleItem
 *
 * @property $id
 * @property $customer_id
 * @property $sale_id
 * @property $product_variant_id
 * @property $quantity
 * @property $unit_price
 * @property $expiry_date
 * @property $purchase_price
 * @property $profit
 * @property $profit_per_item
 * @property $created_at
 * @property $updated_at
 * @property $order_id
 * @property $status
 *
 * @property User $user
 * @property ProductVariant $productVariant
 * @property Sale $sale
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SaleItem extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['customer_id', 'sale_id', 'product_variant_id', 'quantity', 'unit_price', 'expiry_date','profit','purchase_price','profit_per_item','order_id','status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id', 'id');
    }

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
    public function sale()
    {
        return $this->belongsTo(\App\Models\Sale::class, 'sale_id', 'id');
    }

}
