<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItemsReturn
 *
 * @property $id
 * @property $order_id
 * @property $order_item_id
 * @property $return_quantity
 * @property $reason_subject
 * @property $return_reason
 * @property $created_at
 * @property $updated_at
 *
 * @property Order $order
 * @property OrderItem $orderItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrderItemsReturn extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['order_id', 'order_item_id', 'return_quantity', 'reason_subject', 'return_reason'];


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
    public function orderItem()
    {
        return $this->belongsTo(\App\Models\OrderItem::class, 'order_item_id', 'id');
    }
    
}
