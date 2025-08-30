<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductBatch
 *
 * @property $id
 * @property $product_variant_id
 * @property $created_by
 * @property $batch_no
 * @property $qty
 * @property $expired_date
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property ProductVariant $productVariant
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductBatch extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['product_variant_id', 'created_by', 'batch_no', 'qty', 'expired_date', 'status'];


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
    public function productVariant()
    {
        return $this->belongsTo(\App\Models\ProductVariant::class, 'product_variant_id', 'id');
    }
    
}
