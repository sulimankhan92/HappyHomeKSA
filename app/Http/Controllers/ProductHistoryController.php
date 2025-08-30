<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\ProductHistory;

class ProductHistoryController extends Controller
{
    public function showHistories($productVariant)
    {
        // Fetch histories related to the product with eager loading for user and product variant
        $histories = ProductHistory::where('product_variant_id', $productVariant)
            ->with(['user', 'productVariant'])
            ->get();

        // Pass the data to the view
        return view('product-variant.product_history', compact('histories'));
    }
}
