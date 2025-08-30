<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasesReturnItem extends Model
{
    use HasFactory;

    protected $table = 'purchases_return_items';

    protected $fillable = [
        'purchases_return_id',
        'product_variant_id',
        'quantity',
        'unit_price',
        'expiry_date',
        'purchase_price',
        'sale_price',
        'item_total',
        'old_qty',
        'old_expiry_date',
        'old_expiry_status',
        'status',
    ];

    // Relationships
    public function purchase()
    {
        return $this->belongsTo(PurchasesReturn::class, 'purchases_return_id');
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
