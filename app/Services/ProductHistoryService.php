<?php

namespace App\Services;

use App\Models\ProductHistory;
use App\Models\ProductVariant;
use App\Models\ProductDetail;

class ProductHistoryService
{
    /**
     * Insert a record into the product_histories table
     *
     * @param int|null $productVariantId
     * @param int|null $productDetailId
     * @param int|null $quantity
     * @param string|null $action
     * @param string|null $details
     * @param int|null $userId
     * @param int|null $status
     * @param int|null $quantity_change
     * @return void
     */
    public function createProductHistory(
        ?int $productVariantId = null,
        ?int $productDetailId = null,
        ?int $quantity = null,
        ?string $action = null,
        ?string $details = null,
        ?int $userId = null,
        ?int $status = null,
        ?string $quantity_change = null
    ) {
//        // Initialize variables
//        $productId = null;
//        $finalProductVariantId = $productVariantId;
//
//        // Case 1: Only product_detail_id is provided
//        if ($productDetailId && !$productVariantId) {
//            // Fetch product_detail to get product_id and product_variant_id
//            $productDetail = ProductDetail::find($productDetailId);
//
//            if ($productDetail) {
//                $productId = $productDetail->product_id;
//                $finalProductVariantId = $productDetail->product_variant_id;
//            } else {
//                Log::error("ProductDetail not found for ID: $productDetailId");
//                return;
//            }
//        }
//
//        // Case 2: Only product_variant_id is provided
//        elseif ($productVariantId && !$productDetailId) {
//            // Fetch product_variant to get product_id
            $productVariant = ProductVariant::find($productVariantId);
//
            if ($productVariant) {
                $productId = $productVariant->product_id;
            }
//        }
//
//        // Case 3: Both product_variant_id and product_detail_id are provided
//        elseif ($productVariantId && $productDetailId) {
//            // Fetch product_detail to get product_id
//            $productDetail = ProductDetail::find($productDetailId);
//
//            if ($productDetail) {
//                $productId = $productDetail->product_id;
//            } else {
//                Log::error("ProductDetail not found for ID: $productDetailId");
//                return;
//            }
//        }
//
//        // Case 4: Neither product_variant_id nor product_detail_id is provided
//        else {
//            Log::error("Either product_variant_id or product_detail_id must be provided.");
//            return;
//        }

        //SALE RETURN -> Order
        if (in_array($quantity_change, ["SALE", "PURCHASES_RETURN"])) {
            $new_quantity = $productVariant->quantity + $quantity;
        } else {
            // PURCHASE or CANCELED
            $new_quantity = $productVariant->quantity - $quantity;
        }

        // Insert into product_histories table
        ProductHistory::create([
            'product_id' => $productId,
            'product_variant_id' => $productVariantId,
            'product_detail_id' => $productDetailId,
            'action' => $action,
            'details' => $details,
            'user_id' => $userId,
            'status' => $status,
            'quantity' => $quantity,
            'previous_quantity' => $new_quantity,
            'current_quantity' => $productVariant->quantity,
            'quantity_change' => $quantity_change
        ]);
    }
}
