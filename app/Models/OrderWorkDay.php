<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderWorkDay
 *
 * @property $id
 * @property $name_en
 * @property $name_ar
 * @property $is_work_day
 * @property $deliveries_per_day
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class OrderWorkDay extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name_en','name_ar', 'is_work_day','deliveries_per_day'];

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('name_en', 'like', $term)
            ->orWhere('is_work_day', 'like', $term);
    }

    public function timeSlots()
    {
        return $this->hasMany(\App\Models\DeliveryTime::class,'order_work_day_id')
            ->select('id','order_work_day_id','time_slot')
            ->where(['status'=>1]);
    }

    public function getOrderWorkDaysTextAttribute()
    {
        return $this->is_work_day ? 'On' : 'Off';
    }

    public static function getOrderWorkDaysOptions()
    {
        return [
            1 => 'On',
            0 => 'Off',
        ];
    }
}
