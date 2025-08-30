<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductPromotion
 *
 * @property $id
 * @property $product_details_id
 * @property $created_by
 * @property $promotion_price
 * @property $starting_date
 * @property $last_date
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property ProductDetail $productDetail
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductPromotion extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['product_details_id', 'created_by', 'promotion_price', 'starting_date', 'last_date', 'status'];


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
    public function productDetail()
    {
        return $this->belongsTo(\App\Models\ProductDetail::class, 'product_details_id', 'id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('id', 'like', $term);
    }

}
