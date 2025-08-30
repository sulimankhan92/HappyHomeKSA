<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 *
 * @property $id
 * @property $name_en
 * @property $name_ar
 * @property $iso_code
 * @property $phone_code
 * @property $currency
 * @property $created_at
 * @property $updated_at
 *
 * @property ProductManufacturer[] $productManufacturers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Country extends Model
{
    
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name_en', 'name_ar', 'iso_code', 'phone_code', 'currency'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productManufacturers()
    {
        return $this->hasMany(\App\Models\ProductManufacturer::class, 'id', 'country_id');
    }
    
}
