<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductPacking
 *
 * @property $id
 * @property $created_by
 * @property $packaging_level
 * @property $quantity
 * @property $conversion_rate
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property ProductDetail[] $productDetails
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductPacking extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['created_by', 'packaging_level', 'quantity', 'conversion_rate', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productDetails()
    {
        return $this->hasMany(\App\Models\ProductDetail::class, 'id', 'product_packaging_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('packaging_level', 'like', $term)
            ->orWhere('quantity', 'like', $term);
    }

    public function getStatusTextAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    public static function getStatusOptions()
    {
        return [
            0 => 'Inactive',
            1 => 'Active',
        ];
    }

    public static function getPackagingLevel()
    {
        return [
            '1 piece' => '1 piece',
            '6 pieces' => '6 pieces',
            'Dozen' => 'Dozen',
            'Carton' => 'Carton',
            'Box' => 'Box'
        ];
    }
}
