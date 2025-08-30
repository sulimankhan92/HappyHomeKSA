<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class ProductHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'product_detail_id',
        'quantity',
        'action',
        'details',
        'user_id',
        'status',
        'previous_quantity',
        'current_quantity',
        'quantity_change',
    ];

    /**
     * Get the product associated with the history.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the product associated with the history.
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /**
     * Get the user who performed the action.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
