<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from_date');
        $to = $request->input('to_date');
        $status = $request->input('status');

        $query = Order::query()
            ->whereIn('status', [1, 2, 3]) // always apply
            ->orderBy('created_at', 'desc'); // always apply

        if ($status) {
            $query->where('status', $status);
        }

        if ($from && $to) {
            $query->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
        }

        $orders = $query->get();

        $statusOptions = Order::getStatusOptions(); // <- Add this
        // Filter only keys 1 to 4 and 8
        $statusOptions = array_filter($statusOptions, function ($key) {
            return in_array($key, [1, 2, 3, 4, 8]);
        }, ARRAY_FILTER_USE_KEY);

        $roleName='captain';
        $captains = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get();

        $roleName='collector';
        $collectors = User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->get();

        return view('orders.current_orders', compact('orders', 'statusOptions', 'captains', 'collectors'));
    }

    public function verification(Request $request)
    {
        $query = Order::query()
            ->where('is_order_verified', 0)
            ->whereNotNull('user_order_delivered_by');

        // Filter by selected captain
        if ($request->filled('rider_id')) {
            $query->where('user_order_delivered_by', $request->rider_id);
        }

        // Filter by date range
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('created_at', [
                $request->from . ' 00:00:00',
                $request->to . ' 23:59:59',
            ]);
        }

        $orders = $query->get();

        // Fetch all captains (users with role "captain")
        $captains = User::whereHas('roles', function ($query) {
            $query->where('name', 'captain');
        })->get();

        return view('orders.verification', compact('orders', 'captains'));
    }

    // public function verification()
    // {
    //     $orders = Order::where('is_order_verified', 0)
    //         ->whereNotNull('user_order_delivered_by')
    //         ->get();

    //     // $captains = User::whereRoleIs('')->get();
    //     $roleName='captain';
    //     $captains = User::whereHas('roles', function ($query) use ($roleName) {
    //         $query->where('name', $roleName); // Replace $roleName with the desired role
    //     })->get();

    //     return view('orders.verification', compact('orders','captains'));
    // }

    public function verify($id)
    {
        $order = Order::findOrFail($id);
        $order->is_order_verified = 1;
        $order->order_verified_by = Auth::id(); // assuming you're using auth
        $order->order_verified_date = now(); // set current timestamp
        $order->save();

        return redirect()->back()->with('success', 'Order verified successfully.');
    }

    public function tax_summary(Request $request)
    {
        $from = $request->input('from_date');
        $to = $request->input('to_date');
        $status = $request->input('status');

        $orders = collect(); // empty collection by default

        if ($from || $to || $status) {
            $query = Order::query()
                ->whereIn('status', [1, 2, 3, 4, 5, 6, 7]);

            if ($status) {
                $query->where('status', $status);
            }

            if ($from && $to) {
                $query->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
            }

            $orders = $query->get();
        }

        $summary = [
            'order_count' => $orders->count(),
            'total_tax' => $orders->sum('total_tax'),
            'total_amount' => $orders->sum('total_amount'),
        ];

        $statusOptions = Order::getStatusOptions(); // <- Add this
        // Filter only keys 1 to 4 and 8
        $statusOptions = array_filter($statusOptions, function ($key) {
            return in_array($key, [1, 2, 3, 4, 8]);
        }, ARRAY_FILTER_USE_KEY);

        return view('orders.tax_summary', compact('orders','summary', 'from', 'to', 'status', 'statusOptions'));
    }

    public function assignUser(Request $request)
    {
        $riderId = $request->input('rider_id');
        $collceter_id = $request->input('collceter_id');
        $orderIds = $request->input('order_ids', []);

        if (!empty($riderId) && count($orderIds)) {
            Order::whereIn('id', $orderIds)->update([
                'user_order_delivered_by' => $riderId,
            ]);

            return redirect()->back()->with('success', 'Orders assigned successfully.');
        }

        if (!empty($collceter_id) && count($orderIds)) {
            Order::whereIn('id', $orderIds)->update([
                'user_order_collected_by' => $collceter_id,
            ]);

            return redirect()->back()->with('success', 'Orders assigned successfully.');
        }

        return redirect()->back()->with('error', 'No rider or orders selected.');
    }

}
