<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SecondaryCategoryImage
 *
 * @property $id
 * @property $secondary_category_id
 * @property $images
 * @property $order
 * @property $display_status
 * @property $created_at
 * @property $updated_at
 * @property $created_by
 *
 * @property SecondaryCategory $secondaryCategory
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class SecondaryCategoryImage extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['secondary_category_id', 'images', 'order', 'display_status','created_by'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function secondaryCategory()
    {
        return $this->belongsTo(\App\Models\SecondaryCategory::class, 'secondary_category_id', 'id');
    }

}
