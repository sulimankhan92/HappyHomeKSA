<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseReturnItem
 *
 * @property $id
 * @property $purchase_return_id
 * @property $purchase_item_id
 * @property $product_variant_id
 * @property $quantity_returned
 * @property $reason_for_return
 * @property $refund_amount
 * @property $created_at
 * @property $updated_at
 *
 * @property PurchaseReturn $purchaseReturn
 * @property PurchaseItem $purchaseItem
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PurchaseReturnItem extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['purchase_return_id', 'purchase_item_id', 'product_variant_id', 'quantity_returned', 'reason_for_return', 'refund_amount'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchaseReturn()
    {
        return $this->belongsTo(\App\Models\PurchaseReturn::class, 'purchase_return_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchaseItem()
    {
        return $this->belongsTo(\App\Models\PurchaseItem::class, 'purchase_item_id', 'id');
    }

}
