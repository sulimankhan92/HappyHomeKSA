<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property $id
 * @property $name_en
 * @property $name_ar
 * @property $detail_en
 * @property $detail_ar
 * @property $order
 * @property $status
 * @property $gb_color
 * @property $text_color
 * @property $created_at
 * @property $updated_at
 *
 * @property CategoryImage[] $categoryImages
 * @property SecondaryCategory[] $secondaryCategories
 * @property SecondaryCategory[] $secondaryCategoriesList
 * @property Product[] $products
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Category extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name_en', 'name_ar', 'detail_en', 'detail_ar', 'order', 'status','gb_color','text_color'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categoryImages()
    {
        return $this->hasMany(\App\Models\CategoryImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function secondaryCategories()
    {
        return $this->hasMany(\App\Models\SecondaryCategory::class);
    }

    public function secondaryCategoriesList()
    {
        return $this->hasMany(\App\Models\SecondaryCategory::class,'category_id')
            ->where('status', '1')
            ->orderBy('order','asc');
    }

    public function categoryActiveImages()
    {
        return $this->hasMany(\App\Models\CategoryImage::class)->where('display_status','1');
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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_secondary_categories')->withTimestamps();
    }

    public function image()
    {
        return $this->hasOne(\App\Models\CategoryImage::class)->select(['category_id', 'file_name'])->orderBy('id', 'asc');
    }

    public static function getStatusOptions()
    {
        return [
            0 => 'Inactive',
            1 => 'Active',
        ];
    }

}
