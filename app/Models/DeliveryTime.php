<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DeliveryTime
 *
 * @property $id
 * @property $order_work_day_id
 * @property $time_slot
 * @property $status
 * @property $urgent_basis
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class DeliveryTime extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['time_slot', 'urgent_basis','order_work_day_id','status'];

    public function getOrderWorkDaysTextAttribute()
    {
        return $this->status ? 'On' : 'Off';
    }

    public static function getOrderWorkDaysOptions()
    {
        return [
            1 => 'On',
            0 => 'Off',
        ];
    }
}
