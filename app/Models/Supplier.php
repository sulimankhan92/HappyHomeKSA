<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Supplier
 *
 * @property $id
 * @property $name
 * @property $company_name
 * @property $vat_number
 * @property $phone_number
 * @property $image
 * @property $country
 * @property $address
 * @property $location_link
 * @property $status
 * @property $created_at
 * @property $updated_at
 *
 * @property Product[] $products
 * @property Purchase[] $purchases
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Supplier extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'company_name', 'vat_number', 'phone_number', 'image', 'country', 'address', 'location_link', 'status'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'id', 'supplier_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function purchases()
    {
        return $this->hasMany(\App\Models\Purchase::class, 'id', 'supplier_id');
    }


    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('name', 'like', $term)
            ->orWhere('company_name', 'like', $term)
            ->orWhere('vat_number', 'like', $term)
            ->orWhere('phone_number', 'like', $term)
            ->orWhere('address', 'like', $term)
            ->orWhere('country', 'like', $term);
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
