<?php

namespace App\Services;

use App\Models\OrdersHistory;
use Illuminate\Support\Facades\Auth;

class OrderHistoryService
{
    public function storeOrderHistory($order_id, $status)
    {
        OrdersHistory::create([
            'user_id' => Auth::id(),
            'order_id' => $order_id,
            'status' => $status,
        ]);
    }
}
