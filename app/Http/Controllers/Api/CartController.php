<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\CartService;

class CartController extends Controller
{
    // Add product to cart
    public function addProductToCart(Request $request)
    {
        $lang = $request->header('lang', 'en');
        $validator = Validator::make($request->all(), [
            'product_variant_id' => 'required|exists:product_variants,id',
            'product_detail_id' => 'required|exists:product_details,id',
            'quantity' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 200);
        }

        // $productVariant = ProductVariant::find($request->product_variant_id);
        $productVariant = ProductVariant::with('product')->find($request->product_variant_id);

        // Add or update cart item
        $cartItem = Cart::where([
            'user_id' => Auth::id(),
            'product_variant_id' => $request->product_variant_id,
            'product_detail_id' => $request->product_detail_id,
        ])->first();

        if($cartItem){
            $total_cart_qty = $cartItem->quantity + $request->quantity;
        }else{
            $total_cart_qty = $request->quantity;
        }

        // Check if the quantity requested is available in stock
        if ($productVariant->quantity < $total_cart_qty) {
            return response()->json([
                'status' => 0,
                'message' => 'Some items in your cart were updated due to limited stock. Items with low quantity were adjusted, and out-of-stock items were removed',
                'available_quantity' => $productVariant->quantity,
            ], 200);
        }

        // Check if the maximum purchase quantity is exceeded
        if ($total_cart_qty > $productVariant->product->max_purchase) {
            return response()->json([
                'status' => 0,
                'message' => 'Maximum purchase quantity exceeded.',
            ], 200);
        }

        if ($request->quantity == 0) {
            $cartItem->delete();
            return response()->json([
                'status' => 0,
                'message' => 'Item is Removed from Cart.',
            ], 200);
        }


        if ($cartItem) {
            // Increment the quantity if the item exists in the cart
            $cartItem->quantity = $total_cart_qty;
            $cart = $cartItem->save();

        } else {
            // Add a new item to the cart
            $cart = Cart::create([
                'user_id' => Auth::id(),
                'product_variant_id' => $request->product_variant_id,
                'product_detail_id' => $request->product_detail_id,
                'quantity' => $request->quantity,
            ]);
        }

        $cart = Cart::where([
            'user_id' => Auth::id(),
            'product_variant_id' => $request->product_variant_id,
            'product_detail_id' => $request->product_detail_id,
        ])->first();

        $userId = Auth::id();

        $cartItems = Cart::with([
            'productVariant.productDetails.productPacking',
            'productVariant.product'
        ])->where(['user_id'=> $userId,'id' => $cart->id])->get();

        $cartItems = $cartItems->map(function ($cartItem) use ($lang) {
            $productVariant = $cartItem->productVariant;

            if (!$productVariant) {
                return null; // Skip if no product variant is found
            }

            // Determine the valid quantity
            $availableQuantity = $productVariant->quantity;
            $requestedQuantity = $cartItem->quantity;
            $validQuantity = $requestedQuantity > $availableQuantity && $availableQuantity != 0
                ? $availableQuantity
                : $requestedQuantity;

            // Skip items with zero valid quantity
            if ($validQuantity <= 0) {
                return null;
            }

            // Filter the `productDetails` to get the one matching `product_detail_id` from the cart
            $productDetail = $productVariant->productDetails
                ->firstWhere('id', $cartItem->product_detail_id);

            // Calculate total price and add 15%
            // $price = $productDetail->price ?? 0;
            // $totalPrice = $price * $validQuantity;
            // $totalPriceWithTax = $totalPrice + ($totalPrice * 0.15);

            $price = $productDetail->price ?? 0;
            $totalPrice = $price * $validQuantity;
            // Calculate the tax (15% of the total price)
            $taxAmount = $totalPrice * 0.15;
            // Subtract the tax from the total price
            $totalPriceWithTax = $totalPrice - $taxAmount;

            // Include product details
            $product = $productVariant->product;

            return [
                'cart_id' => $cartItem->id,
                // Product
                'name_en' => ($lang === 'ar') ? $product->name_ar : $product->name_en,
                'name_ar' => $product->name_ar,
                'description_en' => ($lang === 'ar') ? $product->description_ar : $product->description_en,
                'description_ar' => $product->description_ar,
                'min_purchase' => $product->min_purchase,
                'max_purchase' => $product->max_purchase,
                // Variant
                'product_variant_id' => $cartItem->product_variant_id,
                'quantity' => $validQuantity, // Use valid quantity
                'product_id' => $product->id,
                'weight' => $productVariant->weight . ' ' . $productVariant->unit->name,
                // Details
                'product_detail_id' => $productDetail->id ?? null,
                'price' => $price,
                'old_price' => $productDetail->old_price ?? null,
                // 'price_with_tax' => $price + ($price * 0.15) ?? null,
                'product_packing' => $productDetail->productPacking->packaging_level ?? null,
                'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
                'total_item_price' => $totalPrice, // Total price without tax
                'total_item_price_with_out_tax' => $totalPriceWithTax, // Total price with out 15% tax
                'total_item_tax' => $totalPrice - $totalPriceWithTax, // Total 15% tax
            ];
        })->filter();

        return response()->json([
            'status'=> 1,
            'message' => 'Product is successfully added to cart',
            // 'cart' => $cart,
            'cart_items' => $cartItems->values(),
        ],200);
    }

    public function getProductAddToCartList(Request $request)
    {
        $userId = Auth::id();
        $lang = $request->header('lang', 'en');

        $cartItems = $this->getUserCartItems($userId);
        $processedItems = $this->processCartItems($cartItems, $lang);

        $totals = $this->calculateTotals($processedItems, $request);

        return response()->json([
            'cart_items' => $processedItems->values(),
            'totals' => $totals
        ]);
    }

    private function getUserCartItems($userId)
    {
        return Cart::with([
            'productVariant.productDetails.productPacking',
            'productVariant.product.productFirstimage',
            'productVariant.unit'
        ])->where('user_id', $userId)->get();
    }

    private function processCartItems($cartItems, $lang)
    {
        return $cartItems->map(function ($cartItem) use ($lang) {
            if (!$cartItem->productVariant) {
                return null;
            }

            [$validQuantity, $usedAvailable] = $this->calculateValidQuantity(
                $cartItem->quantity,
                $cartItem->productVariant->quantity
            );

            if ($validQuantity <= 0) {
                return null;
            }

            $formattedItem = $this->formatCartItem($cartItem, $validQuantity, $lang);
            $formattedItem['is_quantity_changed'] = $usedAvailable;

            return $formattedItem;
        })->filter();
    }

    private function calculateValidQuantity($requested, $available)
    {
        if ($available == 0) {
            return [0, false]; // No quantity available
        }

        if ($requested > $available) {
            return [$available, true]; // Used available quantity (limited stock)
        }

        return [$requested, false]; // Used requested quantity (enough stock)
    }

    // private function processCartItems($cartItems, $lang)
    // {
    //     return $cartItems->map(function ($cartItem) use ($lang) {
    //         if (!$cartItem->productVariant) {
    //             return null;
    //         }

    //         $validQuantity = $this->calculateValidQuantity(
    //             $cartItem->quantity,
    //             $cartItem->productVariant->quantity
    //         );

    //         if ($validQuantity <= 0) {
    //             return null;
    //         }

    //         return $this->formatCartItem($cartItem, $validQuantity, $lang);
    //     })->filter();
    // }

    // private function calculateValidQuantity($requested, $available)
    // {
    //     return ($requested > $available && $available != 0)
    //         ? $available
    //         : $requested;
    // }

    private function formatCartItem($cartItem, $quantity, $lang)
    {
        $productVariant = $cartItem->productVariant;
        $productDetail = $productVariant->productDetails
            ->firstWhere('id', $cartItem->product_detail_id);
        $product = $productVariant->product;

        $price = $productDetail->price ?? 0;
        $totalPrice = $price * $quantity;
        $originalPrice = $totalPrice / 1.15;
        $taxAmount = $totalPrice - $originalPrice;

        return [
            'cart_id' => $cartItem->id,
            'name_en' => $lang === 'ar' ? $product->name_ar : $product->name_en,
            'name_ar' => $product->name_ar,
            'description_en' => $lang === 'ar' ? $product->description_ar : $product->description_en,
            'description_ar' => $product->description_ar,
            'min_purchase' => $product->min_purchase,
            'max_purchase' => $product->max_purchase,
            'product_variant_id' => $cartItem->product_variant_id,
            'quantity' => $quantity,
            'product_id' => $product->id,
            'weight' => $productVariant->weight . ' ' . ($productVariant->unit->name ?? ''),
            'product_detail_id' => $productDetail->id ?? null,
            'price' => $price,
            'old_price' => $productDetail->old_price ?? null,
            'product_packing' => $productDetail->productPacking->packaging_level ?? null,
            'file_name' => $this->getProductImagePath($product),
            'total_item_price' => $totalPrice,
            'total_item_price_with_out_tax' => $originalPrice,
            'total_item_tax' => $taxAmount,
        ];
    }

    private function getProductImagePath($product)
    {
        return isset($product->productFirstimage)
            ? 'public/storage/products/' . $product->productFirstimage->file_name
            : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp';
    }

    private function calculateTotals($cartItems, $request)
    {
        $totalPrice = $cartItems->sum('total_item_price');
        $totalBasePrice = $cartItems->sum('total_item_price_with_out_tax');
        $deliveryCharges = 0;

        $discount = $request->filled('coupon_id')
            ? $this->couponDiscount($request->coupon_id, $totalBasePrice)
            : 0;

        list($totalPrice, $totalBasePrice, $newTaxPortion) = $this->applyDiscount(
            $totalPrice,
            $totalBasePrice,
            $discount
        );

        // $totalTex = $priceWithOutTax * 0.15;
        $grandTotalWithDelivery = $totalBasePrice + $deliveryCharges + $newTaxPortion;

        return [
            'total_price' => $totalPrice, //total in app
            'total_tax' => $newTaxPortion,  //tax in app
            'tax_percent' => '15%',
            'discount' => number_format((float) $discount, 2, '.', ''),
            'delivery_charges' => $deliveryCharges,
            'total_price_with_tax' => $totalBasePrice,
            'total_price_with_out_tax' => $totalBasePrice,
            'grand_total' => $grandTotalWithDelivery,
        ];
    }

    private function applyDiscount($totalPrice, $totalBasePrice, $discount)
    {
        if ($discount > $totalBasePrice) {
            return [0, 0, 0];
        }

        // Calculate how much discount applies to tax (13%) and base price (87%)
        $taxDiscount = $discount * 0.13;
        $priceDiscount = $discount * 0.87;

        // Apply the discounts proportionally
        $taxPortion = $totalPrice - $totalBasePrice; // The tax amount
        $newTaxPortion = max(0, $taxPortion - $taxDiscount);

        // Calculate the adjusted price after discounts
        $adjustedPrice = $totalBasePrice - $priceDiscount;
        $adjustedTotal = $adjustedPrice + $newTaxPortion;

        return [
            $adjustedTotal,          // New total price (including tax after discounts)
            $adjustedPrice,           // New price without tax
            $newTaxPortion
        ];
    }

    // public function getProductAddToCartList(Request $request)
    // {
    //     $userId = Auth::id();
    //     $lang = $request->header('lang', 'en');

    //     $cartItems = Cart::with([
    //         'productVariant.productDetails.productPacking',
    //         'productVariant.product'
    //     ])->where('user_id', $userId)->get();

    //     $cartItems = $cartItems->map(function ($cartItem) use ($lang) {
    //         $productVariant = $cartItem->productVariant;

    //         if (!$productVariant) {
    //             return null; // Skip if no product variant is found
    //         }

    //         // Determine the valid quantity
    //         $availableQuantity = $productVariant->quantity;
    //         $requestedQuantity = $cartItem->quantity;
    //         $validQuantity = $requestedQuantity > $availableQuantity && $availableQuantity != 0
    //             ? $availableQuantity
    //             : $requestedQuantity;

    //         // Skip items with zero valid quantity
    //         if ($validQuantity <= 0) {
    //             return null;
    //         }

    //         // Filter the `productDetails` to get the one matching `product_detail_id` from the cart
    //         $productDetail = $productVariant->productDetails
    //             ->firstWhere('id', $cartItem->product_detail_id);

    //         // Calculate total price and add 15%
    //         // $price = $productDetail->price ?? 0;
    //         // $totalPrice = $price * $validQuantity;
    //         // $totalPriceWithTax = $totalPrice + ($totalPrice * 0.15);

    //         $price = $productDetail->price ?? 0;
    //         $totalPrice = $price * $validQuantity;
    //         // Calculate the tax (15% of the total price)
    //         $taxAmount = $totalPrice * 0.15;

    //         $original_price = $totalPrice / (1 + 15 / 100);
    //         $tax_amount = $totalPrice - $original_price;

    //         // Subtract the tax from the total price
    //         $totalPriceWithTax = $original_price;

    //         // Include product details
    //         $product = $productVariant->product;

    //         return [
    //             'cart_id' => $cartItem->id,
    //             // Product
    //             'name_en' => ($lang === 'ar') ? $product->name_ar : $product->name_en,
    //             'name_ar' => $product->name_ar,
    //             'description_en' => ($lang === 'ar') ? $product->description_ar : $product->description_en,
    //             'description_ar' => $product->description_ar,
    //             'min_purchase' => $product->min_purchase,
    //             'max_purchase' => $product->max_purchase,
    //             // Variant
    //             'product_variant_id' => $cartItem->product_variant_id,
    //             'quantity' => $validQuantity, // Use valid quantity
    //             'product_id' => $product->id,
    //             'weight' => $productVariant->weight . ' ' . $productVariant->unit->name,
    //             // Details
    //             'product_detail_id' => $productDetail->id ?? null,
    //             'price' => $price,
    //             'old_price' => $productDetail->old_price ?? null,
    //             // 'price_with_tax' => $price + ($price * 0.15) ?? null,
    //             'product_packing' => $productDetail->productPacking->packaging_level ?? null,
    //             'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
    //             'total_item_price' => $totalPrice, // Total price without tax
    //             'total_item_price_with_out_tax' => $totalPriceWithTax, // Total price with out 15% tax
    //             'total_item_tax' => $totalPrice - $totalPriceWithTax, // Total 15% tax
    //         ];
    //     })->filter(); // Remove null values

    //     // Calculate totals for all products
    //     $totalPrice = $cartItems->sum('total_item_price');
    //     $totalPriceWithOutTax = $cartItems->sum('total_item_price_with_out_tax');
    //     $deliveryCharges = 0; // Fixed delivery charges

    //      // $totalTax = $cartItems->sum('total_item_tax');
    //      // Add delivery charges to the total

    //     $discount = '00.00';
    //     if(!empty($request->coupon_id)){
    //         $discount = $this->couponDiscount($request->coupon_id, $totalPriceWithOutTax);
    //     }

    //     $totalTex = $totalPriceWithOutTax * 0.15;

    //     if($discount>$totalPriceWithOutTax){
    //         $totalPriceWithOutTax = 0;
    //         $totalPrice = 0;
    //     }else{
    //         $totalPrice = $totalPrice - $discount;
    //         $totalPriceWithOutTax = $totalPriceWithOutTax - $discount;
    //     }

    //     // $totalTex = $totalPriceWithOutTax * 0.15;


    //     $grandTotalWithDelivery = $totalPriceWithOutTax + $deliveryCharges + $totalTex;

    //     $discount = number_format((float) $discount, 2, '.', '');

    //     // Include the totals in the response
    //     return response()->json([
    //         'cart_items' => $cartItems->values(),
    //         'totals' => [
    //             'total_price' => $totalPrice , // removerdddddddddddddddddddd // removerdddddddddddddddddddd
    //             'total_tax' => $totalTex,
    //             'tax_percent' => '15%',
    //             'discount' => $discount,
    //             'delivery_charges' => $deliveryCharges, // Delivery charges
    //             'total_price_with_tax' => $totalPriceWithOutTax,
    //             'total_price_with_out_tax' => $totalPriceWithOutTax, // Total price of all items with 15% tax  // removerdddddddddddddddddddd // removerdddddddddddddddddddd
    //             'grand_total' => $grandTotalWithDelivery, // Grand total including delivery charges
    //         ]
    //     ]);

    // }

    public function couponDiscount($coupon_id, $totalPriceWithOutTax)
    {
        $total = '00.00';

        $coupon = Coupon::find($coupon_id);

        if($coupon->type == "FIXED_AMOUNT"){
            $total = $coupon->amount;
        }

        if ($coupon->type == "PERCENTAGE") {
            $percentage = $coupon->percentage;
            $total = ($percentage / 100) * $totalPriceWithOutTax;
        }
        return $total;
    }

    public function delete_cart_item(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|exists:carts,id',
        ]);

        // Retrieve the credit card by ID
        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        // Delete the credit card
        $cart->delete();

        // Return a success response
        return response()->json(['status'=>1,'message' => 'card item deleted successfully.'], 200);
    }

    public function update_item_qty_in_cards(Request $request)
    {
        return response()->json(['status'=> 0,'message' => 'This API is no more working', 'error' => $validator->errors()], 422);
        $validator = Validator::make($request->all(), [
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        if($request->quantity <= 0){
            $cart = Cart::where('id', $request->cart_id)
                ->where('user_id', Auth::id())
                ->first();
            $cart->delete();
        }

        // Retrieve the credit card by ID
        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$cart) {
            return response()->json(['status'=>0, 'message' => 'card item not found or unauthorized action.'], 404);
        }

        if($request->quantity==0){
            $cart->delete();
        }else{
            $cart->quantity = $request->quantity;
            $cart->save();
        }

        // Return a success response
        return response()->json(['status'=>1,'message' => 'card item updated successfully.'], 200);
    }

    public function update_item_qty_in_cards_home_screen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_variant_id' => 'required',
            'product_detail_id' => 'required',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 200);
        }

        $productVariant = ProductVariant::with(['product', 'productDetails' => function($query) use ($request) {
            $query->where('id', $request->product_detail_id);
        }])->find($request->product_variant_id);

        if (!$productVariant || $productVariant->productDetails->isEmpty()) {
            return response()->json([
                'status' => 0,
                'message' => 'Product Variant or Detail not found',
            ], 200);
        }

        // Accessing the product detail and its product packing
        $productDetail = $productVariant->productDetails->first();
        $pakQty = $productDetail->productPacking->quantity;

        // Add or update cart item
        $cartItem = Cart::where([
            'user_id' => Auth::id(),
            'product_variant_id' => $request->product_variant_id,
            'product_detail_id' => $request->product_detail_id,
        ])->first();

        // $total_cart_qty = $pakQty * $request->quantity;
        $total_cart_qty = $request->quantity;

        // Check if the quantity requested is available in stock
        if ($productVariant->quantity < $total_cart_qty) {
            return response()->json([
                'status' => 0,
                'message' => 'Not enough stock available',
                'available_quantity' => $productVariant->quantity,
            ], 200);
        }

        // Check if the maximum purchase quantity is exceeded
        if ($request->quantity > $productVariant->product->max_purchase) {
            return response()->json([
                'status' => 0,
                'message' => 'Maximum purchase quantity exceeded.',
            ], 200);
        }

        $attributes = [
            'product_variant_id' => $request->product_variant_id,
            'product_detail_id' => $request->product_detail_id,
            'user_id' => Auth::id(),
        ];

        // Define the values to update or create the cart record
        $values = [
            'quantity' => $request->quantity,
            'price' => $request->price,
            // Add any other fields you want to update or set when creating a new record
        ];

        // Use updateOrCreate to find or create a cart record
        $cart = Cart::updateOrCreate($attributes, $values);

        // Handle quantity logic
        if ($request->quantity == 0) {
            $cart->delete();
        }
        // else {
        // Cart::updateOrCreate($attributes, $values);
        // $cart->quantity = $request->quantity;
        // $cart->save();
        // }


        // // Retrieve the credit card by ID
        // $cart = Cart::where('product_variant_id', $request->product_variant_id)
        //     ->where('product_detail_id', $request->product_detail_id)
        //     ->where('user_id', Auth::id())
        //     ->first();

        // if (!$cart) {
        //     return response()->json(['status'=>0, 'message' => 'card item not found or unauthorized action.'], 404);
        // }

        // if($request->quantity==0){
        //     $cart->delete();
        // }else{
        //     $cart->quantity = $request->quantity;
        //     $cart->save();
        // }

        // Return a success response
        return response()->json(['status'=>1,'message' => 'card item updated successfully.'], 200);
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
