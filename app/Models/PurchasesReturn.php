<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasesReturn extends Model
{
    protected $perPage = 20;

    public $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
//    public function user()
//    {
//        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id', 'id');
    }

    public function createdbyUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by', 'id');
    }

    public function purchaseReturnItems()
    {
        return $this->hasMany(\App\Models\PurchasesReturnItem::class);
    }

    public function scopeSearch($query, $term)
    {
        $term = '%' . $term . '%';
        return $query->where('invoice_no', 'like', $term)
            ->orWhere('total_amount', 'like', $term)
            ->orWhere('invoice_date', 'like', $term);
    }
}
