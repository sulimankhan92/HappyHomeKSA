<?php

namespace App\Http\Controllers;

use App\Models\ProductDetail;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function edit($id)
    {
        $productDetail = ProductDetail::findOrFail($id);
        return response()->json($productDetail);
    }

    public function update(Request $request)
    {
        $productDetail = ProductDetail::findOrFail($request->product_detail_id);
        $productDetail->product_packaging_id = $request->product_packaging_id;
        $productDetail->price = $request->price;
        $productDetail->old_price = $request->old_price;
        $productDetail->status = $request->status;
        $productDetail->save();

        return redirect('product-variants/add-variants/'.$request->product_id)->with('success', 'Product Variant is created successfully.');
    }
}
