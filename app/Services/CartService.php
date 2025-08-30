<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function calculateCartItems($cartItems, $lang)
    {
        return $cartItems->map(function ($cartItem) use ($lang) {
            $productVariant = $cartItem->productVariant;

            if (!$productVariant) {
                return null;
            }

            $availableQuantity = $productVariant->quantity;
            $requestedQuantity = $cartItem->quantity;
            $validQuantity = $requestedQuantity > $availableQuantity && $availableQuantity != 0
                ? $availableQuantity
                : $requestedQuantity;

            if ($validQuantity <= 0) {
                return null;
            }

            $productDetail = $productVariant->productDetails
                ->firstWhere('id', $cartItem->product_detail_id);

            $price = $productDetail->price ?? 0;
            $totalPrice = $price * $validQuantity;
            $taxAmount = $totalPrice * 0.15;
            $totalPriceWithTax = $totalPrice - $taxAmount;

            $product = $productVariant->product;

            return [
                'cart_id' => $cartItem->id,
                'name_en' => ($lang === 'ar') ? $product->name_ar : $product->name_en,
                'name_ar' => $product->name_ar,
                'description_en' => ($lang === 'ar') ? $product->description_ar : $product->description_en,
                'description_ar' => $product->description_ar,
                'min_purchase' => $product->min_purchase,
                'max_purchase' => $product->max_purchase,
                'product_variant_id' => $cartItem->product_variant_id,
                'quantity' => $validQuantity,
                'product_id' => $product->id,
                'weight' => $productVariant->weight . ' ' . $productVariant->unit->name,
                'product_detail_id' => $productDetail->id ?? null,
                'price' => $price,
                'old_price' => $productDetail->old_price ?? null,
                'product_packing' => $productDetail->productPacking->packaging_level ?? null,
                'file_name' => isset($product->productFirstimage) ? 'public/storage/products/' . $product->productFirstimage->file_name : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp',
                'total_item_price' => $totalPrice,
                'total_item_price_with_out_tax' => $totalPriceWithTax,
                'total_item_tax' => $totalPrice - $totalPriceWithTax,
            ];
        })->filter();
    }

    public function calculateCartTotals($cartItems, $couponId = null)
    {
        $totalPrice = $cartItems->sum('total_item_price');
        $totalPriceWithOutTax = $cartItems->sum('total_item_price_with_out_tax');
        $deliveryCharges = 0;

        $discount = '00.00';
        if (!empty($couponId)) {
            $discount = $this->calculateCouponDiscount($couponId, $totalPriceWithOutTax);
        }

        if ($discount > $totalPriceWithOutTax) {
            $totalPriceWithOutTax = 0;
            $totalPrice = 0;
        } else {
            $totalPrice -= $discount;
            $totalPriceWithOutTax -= $discount;
        }

        $totalTax = $totalPrice * 0.15;
        $grandTotalWithDelivery = $totalPriceWithOutTax + $deliveryCharges + $totalTax;

        return [
            'total_price' => $totalPrice,
            'total_tax' => $totalTax,
            'tax_percent' => '15%',
            'discount' => number_format((float)$discount, 2, '.', ''),
            'delivery_charges' => $deliveryCharges,
            'total_price_with_tax' => $totalPriceWithOutTax + $totalTax,
            'total_price_with_out_tax' => $totalPriceWithOutTax,
            'grand_total' => $grandTotalWithDelivery,
        ];
    }

    public function calculateCouponDiscount($couponId, $totalPriceWithOutTax)
    {
        $coupon = Coupon::find($couponId);
        if (!$coupon) {
            return '00.00';
        }

        if ($coupon->type == "FIXED_AMOUNT") {
            return $coupon->amount;
        }

        if ($coupon->type == "PERCENTAGE") {
            return ($coupon->percentage / 100) * $totalPriceWithOutTax;
        }

        return '00.00';
    }
}
