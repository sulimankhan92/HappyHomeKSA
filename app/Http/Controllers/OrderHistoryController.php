<?php

namespace App\Http\Controllers;

use App\Models\OrdersHistory;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function show($orderId)
    {
        $orderHistory = OrdersHistory::with(['order', 'user'])
            ->where('order_id', $orderId)
            ->get();
        return view('order_history.show', compact('orderHistory'));
    }
}
