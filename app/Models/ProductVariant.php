<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductVariant
 *
 * @property $id
 * @property $product_id
 * @property $created_by
 * @property $unit_id
 * @property $weight
 * @property $quantity
 * @property $expiry_date
 * @property $expiry_date_alerts
 * @property $status
 * @property $created_at
 * @property $updated_at
 * @property $purchase_price
 * @property $sale_price
 *
 * @property User $user
 * @property Product $product
 * @property Unit $unit
 * @property ProductBatch[] $productBatches
 * @property ProductDetail[] $productDetails
 * @property PurchaseItem[] $purchaseItems
 * @property SaleItem[] $saleItems
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductVariant extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['product_id', 'created_by', 'unit_id', 'weight', 'quantity', 'expiry_date', 'expiry_date_alerts', 'status','quantity_alerts','purchase_price','sale_price'];


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
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unit()
    {
        return $this->belongsTo(\App\Models\Unit::class, 'unit_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productBatches()
    {
        return $this->hasMany(\App\Models\ProductBatch::class, 'id', 'product_variant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDetails()
    {
        return $this->hasMany(\App\Models\ProductDetail::class);
    }

    public function productFirstDetails()
    {
        return $this->hasOne(\App\Models\ProductDetail::class)
            ->select(['id','product_variant_id', 'product_packaging_id','price','old_price'])
            ->orderBy('id', 'asc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchaseItems()
    {
        return $this->hasMany(\App\Models\PurchaseItem::class, 'id', 'product_variant_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleItems()
    {
        return $this->hasMany(\App\Models\SaleItem::class, 'id', 'product_variant_id');
    }

    public static function getStatusOptions()
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ];
    }
}
