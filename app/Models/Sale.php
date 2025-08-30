<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Sale
 *
 * @property $id
 * @property $customer_id
 * @property $created_by
 * @property $sale_date
 * @property $total_amount
 * @property $notes
 * @property $status
 * @property $total_profit
 * @property $created_at
 * @property $updated_at
 * @property $order_id
 *
 * @property User $user
 * @property User $customer
 * @property SaleItem[] $saleItems
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sale extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['customer_id', 'created_by', 'sale_date', 'total_amount', 'notes', 'status','total_profit','order_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(\App\Models\User::class, 'customer_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function saleItems()
    {
        return $this->hasMany(\App\Models\SaleItem::class, 'id', 'sale_id');
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('total_amount', 'like', $term)
            ->orWhere('sale_date', 'like', $term);
    }

}
