<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        $limit = $request->get('limit', 200);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en');
        $userId = Auth::id();

        $products = Product::with(['productFirstimage', 'productFirstVariant'])
            ->leftJoin('wishlists', function ($join) use ($userId) {
                $join->on('products.id', '=', 'wishlists.product_id')
                    ->where('wishlists.user_id', '=', $userId);
            })
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('carts', function ($join) use ($userId) {
                $join->on('product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', '=', $userId);
            })
            ->where(['products.status' => '2', 'products.top_listed' => 1])
            ->select([
                'products.id',
                'products.name_en',
                'products.name_ar',
                'products.description_en',
                'products.description_ar',
                'products.min_purchase',
                'products.max_purchase',
                DB::raw('MAX(IF(wishlists.id IS NOT NULL, 1, 0)) as is_favorite'),
                DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty')
            ])
            ->groupBy('products.id', 'products.name_en', 'products.name_ar', 'products.description_en', 'products.description_ar', 'products.min_purchase', 'products.max_purchase')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('products.id', 'DESC')
            ->get();

        $products = $products->map(function ($product) use ($lang) {
            $percent = (int)$this->calculatePercentage(
                $product->productFirstVariant->productFirstDetails['old_price'],
                $product->productFirstVariant->productFirstDetails['price']
            );

            if (!empty($product->productFirstVariant->productFirstDetails['id'])) {
                $expiryDate = isset($product->productFirstVariant->expiry_date) ? $product->productFirstVariant->expiry_date : date('Y-m-d', strtotime('-1 week'));

                $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
                $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

                return [
                    'id' => $product->id,
                    'product_variant_id' => $product->productFirstVariant->id ?? '',
                    'product_detail_id' => $product->productFirstVariant->productFirstDetails['id'] ?? '',
                    'name_en' => $name,
                    'name_ar' => $product->name_ar,
                    'detail_en' => $description,
                    'detail_ar' => $product->description_ar,
                    'min_purchase' => $product->min_purchase,
                    'max_purchase' => $product->max_purchase,
                    'price' => $product->productFirstVariant->productFirstDetails['price'] ?? 0,
                    'old_price' => $product->productFirstVariant->productFirstDetails['old_price'] ?? 0,
                    'weight' => isset($product->productFirstVariant) ? $product->productFirstVariant->weight . ' ' . $product->productFirstVariant->unit->name : '',
                    'quantity' => $product->productFirstVariant->quantity ?? '',
                    'sold_out' => isset($product->productFirstVariant) ? ($product->productFirstVariant->quantity === 0 ? 0 : 1) : 0,
                    'expiry_date' => $expiryDate,
                    'expiry_date_status' => $expiryDate < date('Y-m-d') ? 0 : 1,
                    'discount_percent' => $percent,
                    'is_favorite' => $product->is_favorite,
                    'item_add_to_cart_qty' => $product->item_add_to_cart_qty,
                    'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
                ];
            }
        })->filter()->values()->toArray();

        $totalProducts = Product::where(['status'=>'2','top_listed'=>1])->count();

        return response()->json([
            'total_products_count' => $totalProducts,
            'products' => $products,
        ]);
    }

    public function getAllProducts(Request $request)
    {
        $limit = $request->get('limit', 300);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en');
        $userId = Auth::id();

        $search = $request->search_term;

        $products = Product::with(['productFirstimage', 'productFirstVariant'])
            ->leftJoin('wishlists', function ($join) use ($userId) {
                $join->on('products.id', '=', 'wishlists.product_id')
                    ->where('wishlists.user_id', '=', $userId);
            })
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('carts', function ($join) use ($userId) {
                $join->on('product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', '=', $userId);
            })
            ->where(['products.status' => '2'])
            ->when(!empty($search), function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('products.name_en', 'like', "%$search%")
                        ->orWhere('products.name_ar', 'like', "%$search%")
                        ->orWhere('products.barcode', 'like', "%$search%");
                });
            })
            ->select([
                'products.id',
                'products.name_en',
                'products.name_ar',
                'products.description_en',
                'products.description_ar',
                'products.min_purchase',
                'products.max_purchase',
                DB::raw('MAX(IF(wishlists.id IS NOT NULL, 1, 0)) as is_favorite'),
                DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty')
            ])
            ->groupBy('products.id', 'products.name_en', 'products.name_ar', 'products.description_en', 'products.description_ar', 'products.min_purchase', 'products.max_purchase')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('products.id', 'DESC')
            ->get();

        $products = $products->map(function ($product) use ($lang) {
            $expiryDate = isset($product->productFirstVariant) ? $product->productFirstVariant->expiry_date : '';
            $percent = (int) $this->calculatePercentage($product->productFirstVariant->productFirstDetails['old_price'], $product->productFirstVariant->productFirstDetails['price']);

            $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
            $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

            return [
                'id' => $product->id,
                'product_variant_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->id : '',
                'product_detail_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['id'] : '',
                'name_en' => $name,
                'name_ar' => $product->name_ar,
                'detail_en' => $description,
                'detail_ar' => $product->description_ar,
                'min_purchase' => $product->min_purchase,
                'max_purchase' => $product->max_purchase,
                'price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['price'] : 0,
                'old_price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['old_price'] : 0,
                'weight' => isset($product->productFirstVariant) ? $product->productFirstVariant->weight . ' ' . $product->productFirstVariant->unit->name : '',
                // 'quantity' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity : 0,
                // 'sold_out' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity === 0 ? 0 : 1 : 0,
                // 'expiry_date' => isset($product->productFirstVariant) ? $product->productFirstVariant->expiry_date : '',
                // 'expiry_date_status' => $expiryDate ? ($expiryDate < date('Y-m-d') ? 0 : 1) : 0,
                'quantity' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity : '',
                'sold_out' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity === 0 ? 0 : 1 : 0,
                'expiry_date' => isset($product->productFirstVariant->expiry_date) ? $product->productFirstVariant->expiry_date : date('Y-m-d', strtotime('-1 week')),
                'discount_percent' => $percent,
                'expiry_date_status' => $expiryDate ? ($expiryDate < date('Y-m-d') ? 0 : 1) : 0,
                'is_favorite' => $product->is_favorite ? 1 : 0,
                'item_add_to_cart_qty' => $product->item_add_to_cart_qty,
//                'unit_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->unit_id : '',
                'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
            ];
        });

        $totalProducts = Product::where(['status'=>'2'])->count();

        if(!empty($search)){
            $totalProducts = count($products);
        }

        return response()->json([
            'total_products_count' => $totalProducts,
            'products' => $products,
        ]);
    }

    public function getBrandsProducts(Request $request)
    {
        $limit = $request->get('limit', 20);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en');

        $validator = Validator::make($request->all(), [
            'product_brand_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 422,'message' => 'The product brand id field is required', 'error' => $validator->errors()], 422);
        }

        $userId = Auth::id();

        $product_brand_id = $request->product_brand_id;

        $products = Product::with(['productFirstimage', 'productFirstVariant'])
            ->leftJoin('wishlists', function ($join) use ($userId) {
                $join->on('products.id', '=', 'wishlists.product_id')
                    ->where('wishlists.user_id', '=', $userId);
            })
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('carts', function ($join) use ($userId) {
                $join->on('product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', '=', $userId);
            })
            ->where(['products.product_brand_id' => $product_brand_id, 'products.status'=>'2'])
            ->select([
                'products.id',
                'products.name_en',
                'products.name_ar',
                'products.description_en',
                'products.description_ar',
                'products.min_purchase',
                'products.max_purchase',
                DB::raw('MAX(IF(wishlists.id IS NOT NULL, 1, 0)) as is_favorite'),
                DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty')
            ])
            ->groupBy('products.id', 'products.name_en', 'products.name_ar', 'products.description_en', 'products.description_ar', 'products.min_purchase', 'products.max_purchase')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('products.id', 'DESC')
            ->get();

        $products = $products->map(function ($product) use ($lang) {
            $expiryDate = isset($product->productFirstVariant) ? $product->productFirstVariant->expiry_date : '';

            $percent = (int) $this->calculatePercentage($product->productFirstVariant->productFirstDetails['old_price'], $product->productFirstVariant->productFirstDetails['price']);

            $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
            $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

            return [
                'id' => $product->id,
                'product_variant_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->id : '',
                'product_detail_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['id'] : '',
                'name_en' => $name,
                'name_ar' => $product->name_ar,
                'detail_en' => $description,
                'detail_ar' => $product->description_ar,
                'min_purchase' => $product->min_purchase,
                'max_purchase' => $product->max_purchase,
                'price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['price'] : 0,
                'old_price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['old_price'] : 0,
                'weight' => isset($product->productFirstVariant) ? $product->productFirstVariant->weight . ' ' . $product->productFirstVariant->unit->name : '',
                'quantity' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity : '',
                'sold_out' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity === 0 ? 0 : 1 : 0,
                'expiry_date' => isset($product->productFirstVariant->expiry_date) ? $product->productFirstVariant->expiry_date : date('Y-m-d', strtotime('-1 week')),
                'expiry_date_status' => $expiryDate ? ($expiryDate < date('Y-m-d') ? 0 : 1) : 0,
                'discount_percent' => $percent,
                'is_favorite' => $product->is_favorite ? 1 : 0,
                'item_add_to_cart_qty' => $product->item_add_to_cart_qty,
//                'unit_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->unit_id : '',
                'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
            ];
        });

        $totalProducts = Product::where(['product_brand_id' => $product_brand_id, 'status'=>'2'])->count();

        return response()->json([
            'total_products_count' => $totalProducts,
            'products' => $products,
        ]);
    }

    public function getCategoryProducts(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 422,'message' => 'The category id field is required', 'error' => $validator->errors()], 422);
        }

        $limit = $request->get('limit', 20);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en');

        $userId = Auth::id();
        $categoryId = $request->category_id;
        $subCategoryId = $request->sub_category_id;


////4-18-2025
        // $products = Product::with(['productFirstimage', 'productFirstVariant','country'])
        //     ->whereHas('secondaryCategories', function ($query) use ($categoryId, $subCategoryId) {
        //         if ($subCategoryId != 0) {
        //             $query->where('secondary_categories.id', $subCategoryId)
        //                 ->where('secondary_categories.category_id', $categoryId);
        //         } else {
        //             $query->where('secondary_categories.category_id', $categoryId);
        //         }
        //     })
        //     ->leftJoin('wishlists', function ($join) use ($userId) {
        //         $join->on('products.id', '=', 'wishlists.product_id')
        //             ->where('wishlists.user_id', '=', $userId);
        //     })
        //     ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
        //     ->leftJoin('carts', function ($join) use ($userId) {
        //         $join->on('product_variants.id', '=', 'carts.product_variant_id')
        //             ->where('carts.user_id', '=', $userId);
        //     })
        //     ->where(['products.status'=>'2'])
        //     ->select([
        //         'products.id',
        //         'products.name_en',
        //         'products.name_ar',
        //         'products.description_en',
        //         'products.description_ar',
        //         'products.min_purchase',
        //         'products.max_purchase',
        //         DB::raw('MAX(IF(wishlists.id IS NOT NULL, 1, 0)) as is_favorite'),
        //         DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty')
        //     ])
        //     ->groupBy('products.id', 'products.name_en', 'products.name_ar', 'products.description_en', 'products.description_ar', 'products.min_purchase', 'products.max_purchase')
        //     ->limit($limit)
        //     ->offset($offset)
        //     ->get();

        // $products = $products->map(function ($product) use ($lang) {
        //     if(!empty($product->productFirstVariant->productFirstDetails['id'])){
        //         $expiryDate = isset($product->productFirstVariant->expiry_date) ? $product->productFirstVariant->expiry_date :  date('Y-m-d', strtotime('-1 week'));

        //         $percent = (int) $this->calculatePercentage($product->productFirstVariant->productFirstDetails['old_price'], $product->productFirstVariant->productFirstDetails['price']);

        //         $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
        //         $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

        //         return [
        //             'id' => $product->id,
        //             'product_variant_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->id : '',
        //             'product_detail_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['id'] : '',
        //             'name_en' => $name,
        //             'name_ar' => $product->name_ar,
        //             'detail_en' => $description,
        //             'detail_ar' => $product->description_ar,
        //             'min_purchase' => $product->min_purchase,
        //             'max_purchase' => $product->max_purchase,
        //             'price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['price'] : 0,
        //             'old_price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['old_price'] : 0,
        //             'weight' => isset($product->productFirstVariant) ? $product->productFirstVariant->weight . ' ' . $product->productFirstVariant->unit->name : '',
        //             'quantity' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity : '',
        //             'sold_out' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity === 0 ? 0 : 1 : 0,
        //             'expiry_date' => isset($product->productFirstVariant->expiry_date) ? $product->productFirstVariant->expiry_date : date('Y-m-d', strtotime('-1 week')),
        //             'expiry_date_status' => $expiryDate ? ($expiryDate < date('Y-m-d') ? 0 : 1) : 0,
        //             'discount_percent' => $percent,
        //             'is_favorite' => $product->is_favorite ? 1 : 0,
        //             'item_add_to_cart_qty' => $product->item_add_to_cart_qty,
        //             //                'unit_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->unit_id : '',
        //             'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
        //         ];
        //     }
        // })->filter(function ($product) {
        //     return $product !== null;
        // })->values()->toArray();

//        $products = Product::where(['status'=>'2'])->with('productFirstImage', 'productFirstVariant','country')
//            ->whereHas('secondaryCategories', function ($query) use ($categoryId, $subCategoryId) {
//                if ($subCategoryId != 0) {
//                    $query->where('id', $subCategoryId)->where('category_id', $categoryId);
//                } else {
//                    $query->where('category_id', $categoryId);
//                }
//            })
//            ->count();

        ////////////////////////////////Count
        // Build the base query
        $baseQuery = Product::with(['productFirstimage', 'productFirstVariant','country'])
            ->whereHas('secondaryCategories', function ($query) use ($categoryId, $subCategoryId) {
                if ($subCategoryId != 0) {
                    $query->where('secondary_categories.id', $subCategoryId)
                        ->where('secondary_categories.category_id', $categoryId);
                } else {
                    $query->where('secondary_categories.category_id', $categoryId);
                }
            })
            ->leftJoin('wishlists', function ($join) use ($userId) {
                $join->on('products.id', '=', 'wishlists.product_id')
                    ->where('wishlists.user_id', '=', $userId);
            })
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('carts', function ($join) use ($userId) {
                $join->on('product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', '=', $userId);
            })
            ->where(['products.status'=>'2']);

        // Clone the query for total count BEFORE pagination
        $totalCount = (clone $baseQuery)
            ->select('products.id') // minimal select
            ->groupBy('products.id')
            ->get()
            ->count();

        $products = $baseQuery
            ->select([
                'products.id',
                'products.name_en',
                'products.name_ar',
                'products.description_en',
                'products.description_ar',
                'products.min_purchase',
                'products.max_purchase',
                DB::raw('MAX(IF(wishlists.id IS NOT NULL, 1, 0)) as is_favorite'),
                DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty')
            ])
            ->groupBy('products.id', 'products.name_en', 'products.name_ar', 'products.description_en', 'products.description_ar', 'products.min_purchase', 'products.max_purchase')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('products.id', 'DESC')
            ->get();

        $products = $products->map(function ($product) use ($lang) {
            if(!empty($product->productFirstVariant->productFirstDetails['id'])){
                $expiryDate = isset($product->productFirstVariant->expiry_date) ? $product->productFirstVariant->expiry_date :  date('Y-m-d', strtotime('-1 week'));

                $percent = (int) $this->calculatePercentage($product->productFirstVariant->productFirstDetails['old_price'], $product->productFirstVariant->productFirstDetails['price']);

                $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
                $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

                return [
                    'id' => $product->id,
                    'product_variant_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->id : '',
                    'product_detail_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['id'] : '',
                    'name_en' => $name,
                    'name_ar' => $product->name_ar,
                    'detail_en' => $description,
                    'detail_ar' => $product->description_ar,
                    'min_purchase' => $product->min_purchase,
                    'max_purchase' => $product->max_purchase,
                    'price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['price'] : 0,
                    'old_price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['old_price'] : 0,
                    'weight' => isset($product->productFirstVariant) ? $product->productFirstVariant->weight . ' ' . $product->productFirstVariant->unit->name : '',
                    'quantity' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity : '',
                    'sold_out' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity === 0 ? 0 : 1 : 0,
                    'expiry_date' => isset($product->productFirstVariant->expiry_date) ? $product->productFirstVariant->expiry_date : date('Y-m-d', strtotime('-1 week')),
                    'expiry_date_status' => $expiryDate ? ($expiryDate < date('Y-m-d') ? 0 : 1) : 0,
                    'discount_percent' => $percent,
                    'is_favorite' => $product->is_favorite ? 1 : 0,
                    'item_add_to_cart_qty' => $product->item_add_to_cart_qty,
                    //                'unit_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->unit_id : '',
                    'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
                ];
            }
        })->filter(function ($product) {
            return $product !== null;
        })->values()->toArray();

        return response()->json([
            'total_products_count' => $totalCount,
            'products' => $products,
        ]);

        // return response()->json([
        //     'total_products_count' => count($products),
        //     'products' => $products,
        // ]);
    }

    public function getProductDetails(Request $request)
    {
        $userId = Auth::id();
        $lang = $request->header('lang', 'en');

        $products = Product::where('products.id', $request->product_id)
            ->with(['productImages'])
            ->get();

        $is_favorite = 0;
        $existingWishlist = Wishlist::where('user_id', $userId)
            ->where('product_id', $request->product_id)
            ->first();
        if ($existingWishlist) {
            $is_favorite = 1;
        }

        $product_variants = ProductVariant::where(['product_id'=> $request->product_id, 'status'=>'1'])
            ->leftJoin('carts', function ($join) use ($userId) {
                $join->on('product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', '=', $userId);
            })
            ->select(
                'product_variants.*',
                DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty')
            )
            ->with(['unit', 'productDetails' => function ($query) use ($userId) {
                $query->leftJoin('carts as cart_details', function ($join) use ($userId) {
                    $join->on('product_details.id', '=', 'cart_details.product_detail_id')
                        ->where('cart_details.user_id', '=', $userId);
                })
                    ->addSelect(
                        'product_details.*',
                        DB::raw('MAX(IF(cart_details.quantity IS NOT NULL, cart_details.quantity, 0)) as item_add_to_cart_qty')
                    )
                    ->groupBy('product_details.id');
            }])
            ->groupBy('product_variants.id')
            ->get();

        $product = $products->map(function ($product) use ($product_variants, $is_favorite, $lang) {

            $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
            $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

            return [
                'id' => $product->id,
                'name_en' => $name,
                'name_ar' => $product->name_ar,
                'detail_en' => $description,
                'detail_ar' => $product->description_ar,
                'orgin_name_en' => $product->country->name_en,
                'orgin_name_ar' => $product->country->name_ar,
                'min_purchase' => $product->min_purchase,
                'max_purchase' => $product->max_purchase,
                'discount_percent' => 30,
                'is_favorite' => $is_favorite,
                'images' => $product->productImages->map(function ($image) {
                    return ['file_name' => 'public/storage/products/' . $image->file_name];
                }),
                'product_variants' => $product_variants
                    ->filter(function ($product_variant) {
                        return $product_variant->productDetails && $product_variant->productDetails->isNotEmpty();
                    })
                    ->map(function ($product_variant) {
                        $expiryDate = $product_variant->expiry_date ?? '';
                        return [
                            'product_variant_id' => $product_variant->id,
                            'status' => $product_variant->status,
                            'weight_unit' => $product_variant->weight . ' ' . ($product_variant->unit->name ?? ''),
                            'quantity' => $product_variant->quantity,
                            'sold_out' => $product_variant->quantity === 0 ? 0 : 1,
                            'expiry_date' => $product_variant->expiry_date,
                            'expiry_date_status' => $expiryDate ? ($expiryDate < date('Y-m-d') ? 0 : 1) : 0,
                            'product_details' => $product_variant->productDetails
                                ->filter(function ($detail) {
                                    return $detail->status !== '0'; // Exclude details with status '0'
                                })
                                ->map(function ($detail) {
                                    return [
                                        'product_detail_id' => $detail->id,
                                        'price' => $detail->price,
                                        'old_price' => $detail->old_price ?? 0,
                                        'product_packing' => $detail->productPacking->packaging_level ?? '',
                                        'product_piece_par_packing' => $detail->productPacking->quantity ?? '',
                                        'item_add_to_cart_qty' => $detail->item_add_to_cart_qty,
                                    ];
                                }),
                        ];
                    })
                    ->filter(function ($product_variant) {
                        return $product_variant['product_details']->isNotEmpty() || $product_variant['product_details']->status = '0'; // Exclude variants with no details
                    })
                    ->values(),
            ];
        });

        return response()->json($product);
    }

    public function cartRelatedProducts(Request $request)
    {
        $limit = $request->get('limit', 20);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en');
        $userId = Auth::id();

        $products = Product::with(['productFirstimage', 'productFirstVariant'])
            ->leftJoin('wishlists', function ($join) use ($userId) {
                $join->on('products.id', '=', 'wishlists.product_id')
                    ->where('wishlists.user_id', '=', $userId);
            })
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('carts', function ($join) use ($userId) {
                $join->on('product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', '=', $userId);
            })
            ->leftJoin('product_secondary_categories', 'products.id', '=', 'product_secondary_categories.product_id')
            ->where(['products.status' => '2', 'products.top_listed' => 1])
            ->select([
                'products.id',
                'products.name_en',
                'products.name_ar',
                'products.description_en',
                'products.description_ar',
                'products.min_purchase',
                'products.max_purchase',
                DB::raw('MAX(IF(wishlists.id IS NOT NULL, 1, 0)) as is_favorite'),
                DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty'),
                'product_secondary_categories.secondary_category_id'
            ])
            ->groupBy('products.id', 'products.name_en', 'products.name_ar', 'products.description_en', 'products.description_ar', 'products.min_purchase', 'products.max_purchase', 'product_secondary_categories.secondary_category_id')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('products.id', 'DESC')
            ->get();

        $products = $products->map(function ($product) use ($lang) {
            $percent = (int) $this->calculatePercentage(
                $product->productFirstVariant->productFirstDetails['old_price'] ?? 0,
                $product->productFirstVariant->productFirstDetails['price'] ?? 0
            );

            $expiryDate = $product->productFirstVariant->expiry_date ?? date('Y-m-d', strtotime('-1 week'));
            $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
            $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

            return [
                'id' => $product->id,
                'product_variant_id' => $product->productFirstVariant->id ?? '',
                'product_detail_id' => $product->productFirstVariant->productFirstDetails['id'] ?? '',
                'name_en' => $name,
                'name_ar' => $product->name_ar,
                'detail_en' => $description,
                'detail_ar' => $product->description_ar,
                'min_purchase' => $product->min_purchase,
                'max_purchase' => $product->max_purchase,
                'price' => $product->productFirstVariant->productFirstDetails['price'] ?? 0,
                'old_price' => $product->productFirstVariant->productFirstDetails['old_price'] ?? 0,
                'weight' => isset($product->productFirstVariant) ? $product->productFirstVariant->weight . ' ' . $product->productFirstVariant->unit->name : '',
                'quantity' => $product->productFirstVariant->quantity ?? '',
                'sold_out' => isset($product->productFirstVariant) ? ($product->productFirstVariant->quantity === 0 ? 0 : 1) : 0,
                'expiry_date' => $expiryDate,
                'expiry_date_status' => $expiryDate < date('Y-m-d') ? 0 : 1,
                'discount_percent' => $percent,
                'is_favorite' => $product->is_favorite,
                'item_add_to_cart_qty' => $product->item_add_to_cart_qty,
                'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
                'secondary_category_id' => $product->secondary_category_id
            ];
        })->filter()->values()->toArray();

        $totalProducts = Product::where(['status' => '2', 'top_listed' => 1])->count();

        return response()->json([
            'total_products_count' => $totalProducts,
            'products' => $products,
        ]);

    }

    public function searchProducts(Request $request)
    {
        $limit = $request->get('limit', 200);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en');

        $search = $request->search_term;

        $userId = Auth::id();

        $products = Product::with(['productFirstimage', 'productFirstVariant'])
            ->leftJoin('wishlists', function ($join) use ($userId) {
                $join->on('products.id', '=', 'wishlists.product_id')
                    ->where('wishlists.user_id', '=', $userId);
            })
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('carts', function ($join) use ($userId) {
                $join->on('product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', '=', $userId);
            })
            ->where('products.status', '2')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('products.name_en', 'like', "%$search%")
                        ->orWhere('products.name_ar', 'like', "%$search%")
                        ->orWhere('products.barcode', 'like', "%$search%");
                });
            })
            ->select([
                'products.id',
                'products.name_en',
                'products.name_ar',
                'products.description_en',
                'products.description_ar',
                'products.min_purchase',
                'products.max_purchase',
                DB::raw('MAX(IF(wishlists.id IS NOT NULL, 1, 0)) as is_favorite'),
                DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty')
            ])
            ->groupBy('products.id', 'products.name_en', 'products.name_ar', 'products.description_en', 'products.description_ar', 'products.min_purchase', 'products.max_purchase')
            ->limit($limit)
            ->offset($offset)
            ->get();

        $products = $products->map(function ($product) use ($lang) {
            $expiryDate = isset($product->productFirstVariant) ? $product->productFirstVariant->expiry_date : '';

            $percent = (int) $this->calculatePercentage($product->productFirstVariant->productFirstDetails['old_price'], $product->productFirstVariant->productFirstDetails['price']);
            $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
            $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

            return [
                'id' => $product->id,
                'product_variant_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->id : '',
                'product_detail_id' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['id'] : '',
                'name_en' => $name,
                'name_ar' => $product->name_ar,
                'detail_en' => $description,
                'detail_ar' => $product->description_ar,
                'min_purchase' => $product->min_purchase,
                'max_purchase' => $product->max_purchase,
                'price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['price'] : 0,
                'old_price' => isset($product->productFirstVariant) ? $product->productFirstVariant->productFirstDetails['old_price'] : 0,
                'weight' => isset($product->productFirstVariant) ? $product->productFirstVariant->weight . ' ' . $product->productFirstVariant->unit->name : '',
                'quantity' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity : '',
                'sold_out' => isset($product->productFirstVariant) ? $product->productFirstVariant->quantity === 0 ? 0 : 1 : 0,
                'expiry_date' => isset($product->productFirstVariant->expiry_date) ? $product->productFirstVariant->expiry_date : date('Y-m-d', strtotime('-1 week')),
                'expiry_date_status' => $expiryDate ? ($expiryDate < date('Y-m-d') ? 0 : 1) : 0,
                'discount_percent' => $percent,
                'is_favorite' => $product->is_favorite ? 1 : 0,
                'item_add_to_cart_qty' => $product->item_add_to_cart_qty,
                'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
            ];
        });

        $totalProducts = Product::where('status', '2')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name_en', 'like', "%$search%")
                        ->orWhere('name_ar', 'like', "%$search%");
                });
            })
            ->count();

        return response()->json([
            'total_products_count' => $totalProducts,
            'products' => $products,
        ]);
    }

    public function wishListedProducts(Request $request)
    {
        $limit = $request->get('limit', 50);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en');
        $userId = Auth::id();

        $products = Product::with(['productFirstimage', 'productFirstVariant'])
            ->whereHas('wishlists', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
            ->leftJoin('carts', function ($join) use ($userId) {
                $join->on('product_variants.id', '=', 'carts.product_variant_id')
                    ->where('carts.user_id', '=', $userId);
            })
            ->where('products.status', '2')
            ->select([
                'products.id',
                'products.name_en',
                'products.name_ar',
                'products.description_en',
                'products.description_ar',
                'products.min_purchase',
                'products.max_purchase',
                DB::raw('1 as is_favorite'),
                DB::raw('MAX(IF(carts.quantity IS NOT NULL, carts.quantity, 0)) as item_add_to_cart_qty')
            ])
            ->groupBy('products.id', 'products.name_en', 'products.name_ar', 'products.description_en', 'products.description_ar', 'products.min_purchase', 'products.max_purchase')
            ->paginate($limit);

        $products = $products->map(function ($product) use ($lang) {
            $percent = (int)$this->calculatePercentage(
                $product->productFirstVariant->productFirstDetails['old_price'] ?? 0,
                $product->productFirstVariant->productFirstDetails['price'] ?? 0
            );

            $expiryDate = $product->productFirstVariant->expiry_date ?? date('Y-m-d', strtotime('-1 week'));
            $name = ($lang === 'ar') ? $product->name_ar : $product->name_en;
            $description = ($lang === 'ar') ? $product->description_ar : $product->description_en;

            return [
                'id' => $product->id,
                'product_variant_id' => $product->productFirstVariant->id ?? '',
                'product_detail_id' => $product->productFirstVariant->productFirstDetails['id'] ?? '',
                'name_en' => $name,
                'name_ar' => $product->name_ar,
                'detail_en' => $description,
                'detail_ar' => $product->description_ar,
                'min_purchase' => $product->min_purchase,
                'max_purchase' => $product->max_purchase,
                'price' => $product->productFirstVariant->productFirstDetails['price'] ?? 0,
                'old_price' => $product->productFirstVariant->productFirstDetails['old_price'] ?? 0,
                'weight' => isset($product->productFirstVariant) ? $product->productFirstVariant->weight . ' ' . $product->productFirstVariant->unit->name : '',
                'quantity' => $product->productFirstVariant->quantity ?? '',
                'sold_out' => isset($product->productFirstVariant) ? ($product->productFirstVariant->quantity === 0 ? 0 : 1) : 0,
                'expiry_date' => $expiryDate,
                'expiry_date_status' => $expiryDate < date('Y-m-d') ? 0 : 1,
                'discount_percent' => $percent,
                'is_favorite' => $product->is_favorite,
                'item_add_to_cart_qty' => $product->item_add_to_cart_qty,
                'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
                'secondary_category_id' => $product->secondary_category_id
            ];
        })->toArray();

        // $totalProducts = Product::where(['status' => '2'])
        //     ->whereHas('wishlists', function ($query) use ($userId) {
        //         $query->where('user_id', $userId);
        //     })
        //     ->count();

        return response()->json([
            'total_products_count' => count($products),
            'products' => $products,
        ]);
    }

    public function calculatePercentage($old_price, $price) {
        if ($old_price == 0) {
            return 0; // Avoid division by zero
        }

        $difference = $old_price - $price;
        $percentage_change = ($difference / $old_price) * 100;
        return $percentage_change;
    }
}
