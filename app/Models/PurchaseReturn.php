<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PurchaseReturn
 *
 * @property $id
 * @property $purchase_id
 * @property $return_date
 * @property $reason
 * @property $total_refunded
 * @property $invoice_no
 * @property $created_at
 * @property $updated_at
 *
 * @property Purchase $purchase
 * @property PurchaseReturnItem[] $purchaseReturnItems
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class PurchaseReturn extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['purchase_id', 'return_date', 'reason', 'total_refunded','invoice_no'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function purchase()
    {
        return $this->belongsTo(\App\Models\Purchase::class, 'purchase_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseReturnItems()
    {
        return $this->hasMany(\App\Models\PurchaseReturnItem::class, 'id', 'purchase_return_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('invoice_no', 'like', $term)
            ->orWhere('return_date', 'like', $term)
            ->orWhere('reason', 'like', $term)
            ->orWhere('total_refunded', 'like', $term);
    }


}
