<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductImage
 *
 * @property $id
 * @property $product_id
 * @property $file_name
 * @property $order
 * @property $display_status
 * @property $created_at
 * @property $updated_at
 *
 * @property Product $product
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductImage extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['product_id', 'file_name', 'order', 'display_status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id', 'id');
    }
    
}
