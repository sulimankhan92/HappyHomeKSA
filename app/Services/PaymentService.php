<?php

namespace App\Services;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class PaymentService
{
    public function refundPayment($order_id, $amount_refund)
    {
        $order = Order::find($order_id);

        // if (!$order) {
        //     return response()->json(['error' => 'Order not found'], 404);
        // }

        $totalRefund = $amount_refund;
        $refundRemaining = $amount_refund;

        $checkOrderItems = OrderItem::where('order_id', $order->id)
            ->where('status', '!=', 8) // Assuming 8 = canceled status
            ->count();

        // If all items are Canceled,Refund Delivery Charges
        if ($checkOrderItems == 0) {
            $refundRemaining += $order->delivery_cost;
            $totalRefund += $order->delivery_cost;
        }

        // Step 1: Deduct from total_amount_unpaid
        if ($order->total_amount_unpaid > 0) {
            $unpaidDeduct = min($order->total_amount_unpaid, $refundRemaining);
            $order->total_amount_unpaid -= $unpaidDeduct;
            $refundRemaining -= $unpaidDeduct;
        }

        // Step 2: Deduct remaining from wallet_points if possible
        if ($refundRemaining > 0 && $order->wallet_points > 0) {
            $walletDeduct = min($order->wallet_points, $refundRemaining);
            $order->wallet_points -= $walletDeduct;
            $order->total_amount_paid -= $walletDeduct;
            $order->wallet_points_refund += $walletDeduct;
            $refundRemaining -= $walletDeduct;

            //Return Points To Wallet
            $user = User::find($order->customer_id);
            $user->wallet_balance += $walletDeduct;
            $user->save();
        }

        $orderItem = new OrderItem();
        $taxReturn = $orderItem->get_original_price($amount_refund);
        // Step 3: Reduce from total_amount
        $order->total_tax -= $taxReturn[1];
        $order->total_amount -= $totalRefund;

        // Save updated order
        $order->save();

        return response()->json([
            'refunded_amount' => $amount_refund,
            'remaining_refund_unapplied' => $refundRemaining,
            'updated_order' => $order
        ]);
    }

}
