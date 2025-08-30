<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductDetailRequest;
use App\Http\Requests\ProductPackingRequest;
use App\Http\Requests\ProductVariantRequest;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductPacking;
use App\Models\ProductVariant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductVariantController extends Controller
{
    public function add_variants($id)
    {
        $product = Product::where('id',$id)->with(['productVariants'])->get();
        $product_variant = new ProductVariant();
        $product_variants = ProductVariant::where('product_id',$id)->with(['unit','productDetails.productPacking'])->get();
        $product_packing = ProductPacking::all();
//        dd($product_variants[0]->productDetails[0]->productPacking->packaging_level);
        return view('product-variant.create',compact('product','product_variants','product_variant','product_packing'));
    }

    public function store(ProductVariantRequest $request)
    {
        // Check if a product variant with the same weight already exists for this product
        $existingVariant = ProductVariant::where('product_id', $request->product_id)
            ->where(['weight'=> $request->weight,'unit_id'=>$request->unit_id])
            ->first();

        if ($existingVariant) {
            return redirect()->back()->withInput()->with('error', 'A product variant with this weight and unit already exists pleas Variant Details.');
        }

        $product_variant = ProductVariant::create($request->all() + [
                'created_by'=>auth()->id()
            ]);
        if($product_variant){
            return redirect('product-variants/add-variants/'.$request->product_id)->with('success', 'Product Variant is created successfully.');
        }
        return redirect()->back()->with('success', 'Product Variant is created successfully.');
    }

    public function store_packing(ProductDetailRequest $request)
    {
        $product_details = ProductDetail::create($request->all() + [
                'created_by'=>auth()->id()
            ]);
        if($product_details){
            return redirect('product-variants/add-variants/'.$request->product_id)->with('success', 'Product Variant is created successfully.');
        }
        return redirect()->back()->with('success', 'Product Variant is created successfully.');

    }

    public function edit($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        return response()->json($productVariant);
    }

    public function update(Request $request)
    {
        $productVariant = ProductVariant::findOrFail($request->product_variant_id);
        $productVariant->weight = $request->weight;
        $productVariant->unit_id = $request->unit_id;
        $productVariant->purchase_price = $request->purchase_price;
        $productVariant->sale_price = $request->sale_price;
        $productVariant->quantity_alerts = $request->quantity_alerts;
        $productVariant->expiry_date_alerts = $request->expiry_date_alerts;
        $productVariant->expiry_date = $request->expiry_date;
        $productVariant->status = $request->status;
        $productVariant->save();

        return redirect('product-variants/add-variants/'.$request->product_id)->with('success', 'Product Variant is created successfully.');
    }

    public function getProductVariants(Request $request)
    {
        $productId = $request->input('product_id');
        $variants = ProductVariant::where('product_id', $productId)
            ->with(['unit' => function ($query) {
                $query->select('id', 'name'); // Select only the 'id' and 'name' fields from the units table
            }])
            ->get(['id', 'weight', 'unit_id', 'status', 'quantity', 'expiry_date','purchase_price','sale_price']);

//        $variants = ProductVariant::where('product_id', $productId)->with('unit.name')->get(['id', 'weight','unit_id','status','quantity','expiry_date']);

        return response()->json([
            'variants' => $variants
        ]);
    }

    public function getProductDetails(Request $request){
        $variantId = $request->input('variant_id');

        $variants = ProductDetail::where(['product_variant_id' => $variantId, 'status' => '1'])
            ->with('productPacking')
            ->get(['id','product_packaging_id', 'price', 'old_price', 'quantity_instock']);

        return response()->json([
            'variants' => $variants
        ]);
    }

    public function product_out_of_stock()
    {
        $product_variants = ProductVariant::with(['product', 'unit', 'productDetails.productPacking'])
            ->where('quantity', '<=', DB::raw('quantity_alerts')) // Compare quantity with quantity_alerts
            ->get();
        return view('product.product_out_of_stick',compact('product_variants'));
    }

    public function product_expired()
    {
        // $product_variants = ProductVariant::with(['product', 'unit', 'productDetails.productPacking'])
        //     ->where('expiry_date', '<=', Carbon::now())
        //     ->get();
        $product_variants = ProductVariant::with(['product', 'unit', 'productDetails.productPacking'])
            ->whereRaw('expiry_date <= DATE_ADD(CURDATE(), INTERVAL expiry_date_alerts DAY)')
            ->get();
        return view('product.product_expired',compact('product_variants'));
    }

}
