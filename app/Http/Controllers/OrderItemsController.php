<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\Coupon;
use App\Models\CouponAssignedUser;
use App\Models\CouponUser;

use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use App\Services\ProductHistoryService;
use Illuminate\Http\Request;
use App\Services\InvoiceService;
use App\Services\OrderHistoryService;
// use App\Services\CartService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Exports\OrdersExport;
use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;


class OrderItemsController extends Controller
{
    // protected $cartService;
    protected $productHistoryService;
    protected $paymentService;

    public function __construct(ProductHistoryService $productHistoryService, PaymentService $paymentService)
    {
        // $this->cartService = $cartService;
        $this->productHistoryService = $productHistoryService;
        $this->paymentService = $paymentService;
    }

    public function orderItems($id)
    {
        $order = Order::where('id', $id)
            ->with([
                'customer',
                'paymentMethod',
                'orderItems.productDetail.productVariant.product',
                'orderItems.productDetail.productPacking',
                'deliveryAddress'
            ])
            ->first();

        $orderSubTotal = 0;

        // First pass: calculate subtotal from original prices (with tax)
        foreach ($order->orderItems as $item) {
            [$originalPrice, $taxPerUnit] = $item->get_original_price($item->price);
            $orderSubTotal += ($originalPrice + $taxPerUnit) * $item->quantity;
        }

        // Second pass: compute item-level discount breakdowns
        foreach ($order->orderItems as $item) {
            [$originalPrice, $taxPerUnit] = $item->get_original_price($item->price);
            $priceTotalWithTax = ($originalPrice + $taxPerUnit) * $item->quantity;

            // Skip division by zero
            if ($orderSubTotal == 0) {
                $discountRatio = 0;
            } else {
                $discountRatio = $priceTotalWithTax / $orderSubTotal;
            }

            $itemDiscountWithTax = $discountRatio * $order->total_discount;

            // Split discount into tax (13%) and price (87%) components
            $refundTaxPart = $itemDiscountWithTax * 0.13;
            $refundTaxPart = $taxPerUnit - $refundTaxPart;
            $refundPricePart = $itemDiscountWithTax * 0.87;
            $refundPricePart = $originalPrice - $refundPricePart;
            $itemSubtotal = ($refundPricePart+$refundTaxPart)*$item->quantity;

            // Attach new keys
            $item->price_without_discount = $priceTotalWithTax;
            $item->discounted_price = round($refundPricePart, 2);
            $item->discounted_tax = round($refundTaxPart, 2);
            $item->item_subtotal = round($itemSubtotal, 2);
        }

        return view('orders.oder_items', compact('order'));
    }


    ////////////////////////////////////////
    //Change Orders Status From - To
    ////////////////////////////////////////
    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required',
        ]);

        // Find the order
        if($request->status != 4){
            $order = Order::findOrFail($request->order_id);
            $order->status = $request->new_status;
            $order->save();

            $orderHistoryService = new OrderHistoryService();
            $orderHistoryService->storeOrderHistory($request->order_id, $request->new_status);

            return redirect()->back()->with('success', 'Order status updated to Preparing!');
        }
        return redirect()->back()->with('success', 'Order is Already Delivered!');
    }

    ////////////////////////////////////////
    ////Assign Delivery Caption Or Collector
    ////////////////////////////////////////
    public function assignedUserToOrder(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        if (!empty($request->collector_id)) {
            $order->user_order_collected_by = $request->collector_id;
            $order->order_collected_time = now();
        }

        if (!empty($request->captain_id)) {
            $order->user_order_delivered_by = $request->captain_id;
        }

        $order->save(); // Save the changes to the order

        return redirect()->back()->with('success', 'User assigned to order successfully.');
    }

    /////////////////////////////////////////////////////////
    //******Cancellations Of Order or Items Starts from here
    //******
    /////////////////////////////////////////////////////////
    public function orderCancellationRequests()
    {
        $orders = Order::whereIn('status', [7])->paginate(50);
        return view('orders.canceled', compact('orders'));
    }

    ////////////////////////////////////////
    //Cancel Full Order
    ///////////////////////////////////////
    public function updateStatus(Request $request, $orderId, $status)
    {
        $order = Order::with('orderItems')->findOrFail($orderId);

        if ($status == 0) {
            $this->cancelOrderItems($order);
            $this->refundWalletPoints($order);

            $order->status = 8;
            $order->wallet_points_refund = $order->wallet_points;
            $order->save();

            (new OrderHistoryService())->storeOrderHistory($orderId, $order->status, 'Otrder is Canceled');

            return redirect()->route('order-items-canceleds.index')->with('success', 'Order canceled successfully!');
        }

        return redirect()->route('order-items-canceleds.index')->with('info', 'Order status is already the same.');
    }

    private function cancelOrderItems(Order $order)
    {
        $sale = Sale::create([
            'customer_id' => $order->customer_id,
            'order_id' => $order->id, // Assuming the customer is creating the sale
            'created_by' => Auth::id(), // Assuming the customer is creating the sale
            'sale_date' => now(),
            'total_amount' => $order->total_amount,
            'notes' => 'Order #' . $order->id .' is Updated',
            'status' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($order->orderItems as $item) {
            $productVariant = ProductVariant::find($item->product_variant_id);
//           if($item->status != 8){
            if ($productVariant) {
                $productVariant->quantity += $item->quantity;
                $productVariant->save();

                $this->productHistoryService->createProductHistory(
                    $productVariant->id,
                    $item->product_detail_id,
                    $item->quantity,
                    'Order Cancellation',
                    'Product added back to stock from Order #' . $order->id,
                    Auth::id(),
                    1,
                    'CANCELED'
                );
                if($item->status != 8){
                $profitPerItem = $productVariant->sale_price - $productVariant->purchase_price;
                $profit = $profitPerItem * $item->quantity;

                SaleItem::create([
                    'customer_id' => $order->customer_id,
                    'sale_id' => $sale->id,
                    'order_id' => $order->id,
                    'product_variant_id' => $productVariant->id,
                    'expiry_date' => $productVariant->expiry_date,
                    'quantity' => $item->quantity,
                    'purchase_price' => $productVariant->purchase_price,
                    'unit_price' => $productVariant->sale_price,
                    'profit_per_item' => $profitPerItem,
                    'profit' => $profit,
                    'status' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                }
//            }
            }

            $item->status = 8;
            $item->qty_cancelled = $item->quantity;
            $item->save();
        }
    }

    private function refundWalletPoints(Order $order)
    {
        if ($order->wallet_points > 0) {
            $user = User::find($order->customer_id);

            if ($user) {
                $user->wallet_balance += $order->wallet_points;
                $user->save();
            }
        }
    }

    /////////////////////////////////////////////////////////
    //Cancel One/Multiplel Items from Order from + - Button
    //////////////////////////////////////////////////////
    public function updateOrderQuantity(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:0',
        ]);

        // try {
        $order = Order::findOrFail($request->order_id);

        $orderHistoryService = new OrderHistoryService();

        $sale = Sale::create([
            'customer_id' => $order->customer_id,
            'order_id' => $order->id, // Assuming the customer is creating the sale
            'created_by' => Auth::id(), // Assuming the customer is creating the sale
            'sale_date' => now(),
            'total_amount' => $order->total_amount,
            'notes' => 'Order #' . $order->id .' is Updated',
            'status' => '1', // Assuming '1' is the initial status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($request->quantities as $itemId => $newQuantity) {


            $orderItem = $order->orderItems()->where('id', $itemId)->first();
            if (!$orderItem) continue;

            $currentQuantity = $orderItem->quantity;
            if ($currentQuantity == $newQuantity) continue;

            $pricePerUnit = $orderItem->price;
            [$originalPrice, $taxPerUnit] = $orderItem->get_original_price($pricePerUnit);

            $productVariant = ProductVariant::find($orderItem->product_variant_id);

            if ($newQuantity > $currentQuantity) {
                $this->handleQuantityIncrease(
                    $order,
                    $orderItem,
                    $productVariant,
                    $newQuantity - $currentQuantity,
                    $pricePerUnit,
                    $taxPerUnit,
                    $orderHistoryService,
                    $originalPrice,
                    $sale
                );
            } else {
                $this->handleQuantityDecrease(
                    $order,
                    $orderItem,
                    $productVariant,
                    $currentQuantity - $newQuantity,
                    $pricePerUnit,
                    $taxPerUnit,
                    $orderHistoryService,
                    $originalPrice,
                    $sale
                );
                $orderItem->qty_cancelled += $currentQuantity - $newQuantity;
            }

            $orderItem->quantity = $newQuantity;
            $orderItem->save();

            if($order->total_discount>0){
                $this->recalculateOrderTotals($order);
            }
        }

        return redirect()->back()->with('success', 'Order quantities updated successfully!');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('error', 'Failed to update order: ' . $e->getMessage());
        // }
    }

    private function handleQuantityIncrease($order, $orderItem, $variant, $addedQty, $price, $tax, $historyService, $originalPrice, $sale)
    {
        if (!$variant) return;

        $variant->quantity -= $addedQty;
        $variant->save();

        $price = $originalPrice;
        $tax = $tax;
        if($order->total_discount>0){
            $orderSubTotal = $order->total_amount + $order->total_discount - ($order->delivery_cost);
            $itemDiscountedPrice = $this->calculatePerItemDiscount($price, $orderSubTotal, $order->total_discount, 15, $originalPrice);
            //dd($itemDiscountedPrice);
            $price = $itemDiscountedPrice['itemDiscountedPrice'];
            $tax = $itemDiscountedPrice['ItenDiscountedTax'];
        }

        $itemTotal = $addedQty * ($price + $tax);
        $order->total_amount += $itemTotal;
        $order->total_amount_unpaid += $itemTotal;
        $order->total_tax += $addedQty * $tax;
        $order->save();

        $this->productHistoryService->createProductHistory(
            $variant->id,
            $orderItem->product_detail_id,
            $addedQty,
            'Update Quantity Chack Out from Stock',
            'Item is Added to Order # ' . $order->id . ' Item #' . $orderItem->id,
            Auth::id(),
            1,
            'SALE'
        );

        $profitPerItem = $variant->sale_price - $variant->purchase_price;
        $profit = $profitPerItem * $addedQty;

        SaleItem::create([
            'customer_id' => $order->customer_id,
            'sale_id' => $sale->id,
            'order_id' => $order->id,
            'product_variant_id' => $variant->id,
            'expiry_date' => $variant->expiry_date,
            'quantity' => $addedQty,
            'purchase_price' => $variant->purchase_price,
            'unit_price' => $variant->sale_price,
            'profit_per_item' => $profitPerItem,
            'profit' => $profit,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $historyService->storeOrderHistory($order->id, '15', 'Item is Added to Order # ' . $order->id . ' Item #' . $orderItem->id);
    }

    private function handleQuantityDecrease($order, $orderItem, $variant, $removedQty, $price, $tax, $historyService, $originalPrice, $sale)
    {
        if (!$variant) return;

        $variant->quantity += $removedQty;
        $variant->save();

        if($order->total_discount>0){
            // dd('fi discount');
            $orderSubTotal = $order->total_amount + $order->total_discount - ($order->delivery_cost);
            $itemDiscountedPrice = $this->calculatePerItemDiscount($price, $orderSubTotal, $order->total_discount, 15, $originalPrice);

            $itemsSubTotalPrice = $itemDiscountedPrice['itemDiscountedPrice'] * $removedQty;
            $itemsSubTotalTax = $itemDiscountedPrice['ItenDiscountedTax'] * $removedQty;
            $refundAmount = $itemsSubTotalPrice + $itemsSubTotalTax;

            $this->paymentService->refundPayment($orderItem->order_id, $refundAmount, $itemsSubTotalTax);
        }else{

            $refundAmount = $price * $removedQty;
            $this->paymentService->refundPayment($orderItem->order_id, $refundAmount);
        }

        $this->productHistoryService->createProductHistory(
            $variant->id,
            $orderItem->product_detail_id,
            $removedQty,
            'Update Quantity Add to Stock',
            'Item is Canceled from Order # ' . $order->id . ' Item #' . $orderItem->id,
            Auth::id(),
            1,
            'CANCELED'
        );

        //Add items in sales
        $profitPerItem = $variant->sale_price - $variant->purchase_price;
        $profit = $profitPerItem * $removedQty;

        SaleItem::create([
            'customer_id' => $order->customer_id,
            'sale_id' => $sale->id,
            'order_id' => $order->id,
            'product_variant_id' => $variant->id,
            'expiry_date' => $variant->expiry_date,
            'quantity' => $removedQty,
            'purchase_price' => $variant->purchase_price,
            'unit_price' => $variant->sale_price,
            'profit_per_item' => $profitPerItem,
            'profit' => $profit,
            'status' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sale = Sale::find($sale->id);

        if ($sale) {
            $sale->status = '2';
            $sale->save();
        }

        $historyService->storeOrderHistory($order->id, '16','Item is Canceled from Order # ' . $order->id . ' Item #' . $orderItem->id);
    }

    private function calculatePerItemDiscount($itemPriceWithTax, $orderSubtotalWithTax, $totalOrderDiscount, $taxRatePercent = 15, $itemPriceWithoutTax) {
        // Calculate this item's share of the total discount
        $discountRatio = $itemPriceWithTax / $orderSubtotalWithTax;
        $itemDiscountWithTax = $discountRatio * $totalOrderDiscount;

        $itemFullTax = $itemPriceWithoutTax * ($taxRatePercent / 100);

        // Split discount into tax (13%) and price (87%) components
        $refundTaxPart = $itemDiscountWithTax * 0.13;
        $refundPricePart = $itemDiscountWithTax * 0.87;

        return [
            'itemDiscountedPrice' => round($itemPriceWithoutTax - $refundPricePart, 2),
            'ItenDiscountedTax'   => round($itemFullTax - $refundTaxPart, 2),
        ];
    }

    private function recalculateOrderTotals(Order $order)
    {
        // Reset order totals
        $order->total_amount = 0;
        $order->total_tax = 0;
        $order->total_amount_unpaid = 0;

        $orderItemPriceSubTotalBeforeDiscount = 0;
        $orderTaxPerUnitSubTotalBeforeDiscount = 0;

        // Calculate subtotal before discount
        foreach ($order->orderItems as $item) {
            [$originalPrice, $taxPerUnit] = $item->get_original_price($item->price);

            $orderItemPriceSubTotalBeforeDiscount += $originalPrice * $item->quantity;
            $orderTaxPerUnitSubTotalBeforeDiscount += $taxPerUnit * $item->quantity;
        }

        // Calculate the original total before any changes (for comparison)
        $originalSubTotal = $orderItemPriceSubTotalBeforeDiscount + $orderTaxPerUnitSubTotalBeforeDiscount;
        $originalTotalAmount = $originalSubTotal + $order->delivery_cost;

        // Apply discount if exists
        if ($order->total_discount > 0) {
            // Calculate discount portions (13% tax, 87% price)
            $taxDiscount = $order->total_discount * 0.13;
            $priceDiscount = $order->total_discount * 0.87;

            // Apply discounts to subtotals
            $discountedPriceSubTotal = max(0, $orderItemPriceSubTotalBeforeDiscount - $priceDiscount);
            $discountedTaxSubTotal = max(0, $orderTaxPerUnitSubTotalBeforeDiscount - $taxDiscount);

            // Calculate new totals
            $order->total_amount = $discountedPriceSubTotal + $discountedTaxSubTotal + $order->delivery_cost;
            $order->total_tax = $discountedTaxSubTotal;
            $order->total_amount_unpaid = $order->total_amount - $order->total_paid;
        }

        $order->save();
    }

    ///////////////////////////////////
    //Cancel One Full Items from Order
    //////////////////////////////////
    public function updateItemStatus(Request $request, $itemId, $status)
    {
        $item = OrderItem::with(['order.orderItems'])->findOrFail($itemId);

        // Cancel the item
        $item->status = 8;
        $item->qty_cancelled += $item->quantity;
        $item->save();

        // Refund the item amount
        $itemsTotalAmount = $item->price * $item->quantity;
        $this->paymentService->refundPayment($item->order_id, $itemsTotalAmount);

        // Restore product variant quantity
        $this->restoreProductStock($item);

        $order = $item->order;
        $orderHistoryService = new OrderHistoryService();

        // Check if all items in the order are canceled
        $activeItemsCount = $order->orderItems()->where('status', '!=', 8)->count();

        if ($activeItemsCount === 0) {
            $order->cancellation_status = $order->status;
            $order->status = 8;
            $order->save();

            $orderHistoryService->storeOrderHistory(
                $order->id,
                $order->status,
                'Full order canceled - all items canceled'
            );

            return redirect()->route('order-items-canceleds.index')->with('success', 'All order items canceled. Order marked as canceled.');
        }


        $sale = Sale::create([
            'customer_id' => $item->order->customer_id,
            'order_id' => $item->order->id, // Assuming the customer is creating the sale
            'created_by' => Auth::id(), // Assuming the customer is creating the sale
            'sale_date' => now(),
            'total_amount' => $itemsTotalAmount,
            'notes' => 'Order #' . $item->order->id .' is Updated',
            'status' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $productVariant = ProductVariant::where('id', $item->product_variant_id)->first();
        $profitPerItem = $item->price - $productVariant->purchase_price;
        $profit = $profitPerItem * $item->quantity;

        SaleItem::create([
            'customer_id' => $item->order->customer_id,
            'sale_id' => $sale->id,
            'order_id' => $item->order->id,
            'product_variant_id' => $productVariant->id,
            'expiry_date' => $productVariant->expiry_date,
            'quantity' => $item->quantity,
            'purchase_price' => $productVariant->purchase_price,
            'unit_price' => $productVariant->sale_price,
            'profit_per_item' => $profitPerItem,
            'profit' => $profit,
            'status' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $sale = Sale::find($sale->id);

        if ($sale) {
            $sale->status = '2';
            $sale->save();
        }

        // Only one item canceled, not the entire order
        $orderHistoryService->storeOrderHistory(
            $order->id,
            $order->status,
            'Order Item is Canceled. Item ID: ' . $item->id
        );

        return redirect()->back()->with('success', 'Order item canceled successfully.');
    }

    private function restoreProductStock(OrderItem $item)
    {
        $productVariant = ProductVariant::find($item->product_variant_id);

        if ($productVariant) {
            $productVariant->quantity += $item->quantity;
            $productVariant->save();

            $this->productHistoryService->createProductHistory(
                $productVariant->id,
                $item->product_detail_id,
                $item->quantity,
                'Order Cancellation',
                'Product added back to stock from Order #' . $item->order_id . ' by cancellation of item #' . $item->id,
                Auth::id(),
                1,
                'CANCELED'
            );
        }
    }

    ///////////////////////////////////
    //Apply Coupon To Order Order
    //////////////////////////////////
    // public function applyCouponToOrder(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'order_id' => 'required|exists:orders,id',
    //         'coupon_code' => 'required|exists:coupons,code',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => $validator->errors()->first(),
    //         ], 422);
    //     }

    //     $order = Order::with('orderDetails')->find($request->order_id);
    //     $coupon = Coupon::where('code', $request->coupon_code)->first();

    // }

    public function applyCouponToOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|exists:orders,id',
            'coupon_code' => 'required|exists:coupons,code',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }

        $order = Order::find($request->order_id);
        if($order->total_discount > 0){
            return response()->json([
                'success' => false,
                'message' => 'Coupon is already Applied to this Order',
            ], 422);
        }

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon not found.',
            ], 404);
        }

        $userId = $order->customer_id;

        // Check if coupon is active
        if ($coupon->is_active != 1) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon is not active.',
            ], 200);
        }

        if ($coupon->start_date && Carbon::now()->lessThan(Carbon::parse($coupon->start_date))) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon is not yet valid.',
            ], 200);
        }

        if ($coupon->end_date && Carbon::now()->greaterThan(Carbon::parse($coupon->end_date))) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon has expired.',
            ], 200);
        }

        $couponUsageCount = CouponUser::where('coupon_id', $coupon->id)
            ->where('user_id', $userId)
            ->count();

        if ($couponUsageCount > 0 && $couponUsageCount >= $coupon->coupon_use_counts) {
            return response()->json([
                'success' => false,
                'message' => 'You are not eligible to use this coupon.',
            ], 200);
        }

        if ($coupon->coupon_category == 'FIRST_TIME_ORDER') {
            $couponOrderCount = Order::where('customer_id', $userId)->count();

            if ($couponOrderCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not eligible to use this coupon.',
                ], 200);
            }
        }

        if ($coupon->is_for_all_users == 3) {
            $couponIsAssignedCount = CouponAssignedUser::where([
                'user_id' => $userId,
                'coupon_id' => $coupon->id,
                'is_active' => 1,
            ])->count();

            if ($couponIsAssignedCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not eligible to use this coupon.',
                ], 200);
            }
        }

        $couponDetails = [
            'id' => $coupon->id,
            // 'code' => $coupon->code,
            // 'type' => $coupon->type,
            // 'category' => $coupon->coupon_category,
            'amount' => $coupon->type === 'FIXED_AMOUNT' ? $coupon->amount : 0,
            // 'percentage' => $coupon->type === 'PERCENTAGE' ? $coupon->percentage : 0,
            // 'start_date' => $coupon->start_date,
            // 'end_date' => $coupon->end_date,
        ];

        return response()->json([
            'success' => true,
            'message' => 'Coupon successfully validated.',
            'data' => $couponDetails,
        ]);
    }

    public function generateInvoice($order_id)
    {
        $invoiceService = new InvoiceService();
        return $invoiceService->generateOrderInvoice($order_id);
    }

    public function exportOrders(Request $request)
    {
        $orderIds = $request->input('order_ids');
        $exportType = $request->input('export_type');

        if ($exportType === 'pdf') {
            $invoiceService = new InvoiceService();
            return $invoiceService->generateMultipleOrdersInvoicesPrint($orderIds);
        } else if ($exportType === 'excel') {
            // Generate the file name with the current date
            $fileName = 'orders_' . date('Y-m-d') . '.xlsx';
            // Download the Excel file with the dynamic file name
            return Excel::download(new OrdersExport($orderIds), $fileName);
//             return Excel::download(new OrdersExport($orderIds), 'orders.xlsx');
        } else {
            return abort(400, 'Invalid export type provided.');
        }

        // Pass the selected order IDs to the export class
        // return Excel::download(new OrdersExport($orderIds), 'orders.xlsx');
    }
//    public function updateOrderStatus(Request $request)
//    {
//        $order = Order::findOrFail($request->order_id);
//
//        if (!empty($request->collector_id)) {
//            $order->status = $request->collector_id;
//        }
//
//        $order->save(); // Save the changes to the order
//
//        return redirect()->back()->with('success', 'User assigned to order successfully.');
//    }

    public function finalizeCouponApplication($couponId, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $coupon = Coupon::findOrFail($couponId);

        // Calculate the discount amount
        $discountAmount = $coupon->type === 'FIXED_AMOUNT'
            ? $coupon->amount
            : 0;



        // Calculate 13% tax and 87% price portions
        $taxDiscount = $discountAmount * 0.13;
        $priceDiscount = $discountAmount * 0.87;

        // Simulate subtotal before discount
        $orderItemPriceSubTotalBeforeDiscount = $order->total_amount - $order->total_tax - $order->delivery_cost;
        $orderTaxSubTotalBeforeDiscount = $order->total_tax;

        // Apply discounts
        $discountedPriceSubTotal = max(0, $orderItemPriceSubTotalBeforeDiscount - $priceDiscount);
        $discountedTaxSubTotal = max(0, $orderTaxSubTotalBeforeDiscount - $taxDiscount);

        // Recalculate order totals
        $order->total_discount = $discountAmount;
        $order->total_tax = $discountedTaxSubTotal;
        $order->total_amount = $discountedPriceSubTotal + $discountedTaxSubTotal + $order->delivery_cost;
        $order->total_amount_unpaid = $order->total_amount - $order->total_paid;

        $order->save();

        // Save coupon usage
        CouponUser::create([
            'user_id' => $order->customer_id,
            'coupon_id' => $coupon->id,
            'order_id' => $orderId
        ]);

        return redirect()->back()->with('success', "Coupon applied. Discount: $discountAmount");
    }

    public function addLineItemToOrder(Request $request){
        $order = Order::findOrFail($request->order_id);

        // Get original price and tax per unit
        [$originalPrice, $taxPerUnit] = $order->orderItems[0]->get_original_price($request->price);

        // Multiply by quantity
        $quantity = $request->quantity;
        $totalItemPrice = $originalPrice * $quantity;
        $totalItemTax   = $taxPerUnit * $quantity;

        // Update order item
        OrderItem::create([
            'order_id'            => $request->order_id,
            'product_detail_id'   => $request->product_details_id,
            'product_variant_id'  => $request->variant_id,
            'product_id'          => $request->product_id,
            'quantity'            => $quantity,
            'price'               => $request->price,
        ]);

        // Update order totals
        $order->total_tax           += $totalItemTax;
        $order->total_amount        += $totalItemPrice + $totalItemTax;
        $order->total_amount_unpaid = $order->total_amount - $order->total_paid;

        $order->save();

        return redirect()->back()->with('success', "Item is successfully added to Order");
    }

}
