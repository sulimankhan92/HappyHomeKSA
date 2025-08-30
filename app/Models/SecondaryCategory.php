<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SecondaryCategory
 *
 * @property $id
 * @property $category_id
 * @property $name_en
 * @property $name_ar
 * @property $detail_en
 * @property $detail_ar
 * @property $order
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Category $category
 * @property Product[] $products
 * @property SecondaryCategoryImage[] $secondaryCategoryImages
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SecondaryCategory extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['category_id', 'name_en', 'name_ar', 'detail_en', 'detail_ar', 'order', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'id', 'secondary_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function secondaryCategoryImages()
    {
        return $this->hasMany(\App\Models\SecondaryCategoryImage::class);
    }

    public function image()
    {
        return $this->hasOne(\App\Models\SecondaryCategoryImage::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('name_en', 'like', $term)
            ->orWhere('name_ar', 'like', $term)
            ->orWhere('detail_en', 'like', $term)
            ->orWhere('detail_ar', 'like', $term);
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

}
