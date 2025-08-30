<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 *
 * @property $id
 * @property $order_id
 * @property $product_detail_id
 * @property $quantity
 * @property $price
 * @property $tax
 * @property $status
 * @property $item_note
 * @property $product_variant_id
 * @property $product_id
 * @property $qty_cancelled
 * @property $created_at
 * @property $updated_at
 *
 * @property Order $order
 * @property ProductDetail $productDetail
 * @property OrderItemsCanceled[] $orderItemsCanceleds
 * @property OrderItemsReturn[] $orderItemsReturns
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrderItem extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['order_id', 'product_detail_id','product_variant_id','product_id', 'quantity', 'price', 'tax', 'status', 'item_note', 'qty_cancelled'];


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
    public function productDetail()
    {
        return $this->belongsTo(\App\Models\ProductDetail::class, 'product_detail_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItemsCanceleds()
    {
        return $this->hasMany(\App\Models\OrderItemsCanceled::class, 'id', 'order_item_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItemsReturns()
    {
        return $this->hasMany(\App\Models\OrderItemsReturn::class, 'id', 'order_item_id');
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'Pending' : '';
    }

    public static function getStatusOptions()
    {
        return [
            1 => 'Pending',
            2 => 'Canceled',
            3 => 'Processing',
            4 => 'Ready To Deliver',
            5 => 'Shipped',
            6 => 'Delivered',
            7 => 'Free Status',
            8 => 'Canceled',
            9 => 'Return',
        ];
    }

    public function get_original_price($final_price)
    {
        $original_price = $final_price / (1 + 15 / 100);
        $tax_amount = $final_price - $original_price;
        return [round($original_price, 2), round($tax_amount, 2)];
    }
}
