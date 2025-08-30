<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductBrand
 *
 * @property $id
 * @property $name
 * @property $logo
 * @property $status
 * @property $name_ar
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ProductBrand extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'name_ar', 'logo', 'status','created_by'];

    public static function getStatusOptions()
    {
        return [
            1 => 'Active',
            0 => 'Inactive',
        ];
    }
}
