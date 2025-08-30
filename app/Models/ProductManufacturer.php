<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductManufacturer
 *
 * @property $id
 * @property $country_id
 * @property $created_by
 * @property $name_en
 * @property $name_ar
 * @property $description_en
 * @property $description_ar
 * @property $logo
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Country $country
 * @property User $user
 * @property Product[] $products
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductManufacturer extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['country_id', 'created_by', 'name_en', 'name_ar', 'description_en', 'description_ar', 'logo', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class, 'country_id', 'id');
    }

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
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'id', 'product_manufacture_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('name_en', 'like', $term)
            ->orWhere('name_ar', 'like', $term)
            ->orWhere('description_en', 'like', $term)
            ->orWhere('description_ar', 'like', $term);
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
