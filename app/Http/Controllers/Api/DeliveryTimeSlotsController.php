<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeliveryPackage;
use App\Models\DeliveryTime;
use App\Models\Order;
use App\Models\OrderWorkDay;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DeliveryTimeSlotsController extends Controller
{
    // public function getWorkingDays()
    // {
    //     $deliveryTimeSlots = OrderWorkDay::where(['is_work_day'=>1])
    //         ->select('id','name_en','name_ar')
    //         ->get();

    //     return response()->json([
    //         'status'=>1,
    //         'message'=>'Success',
    //         'working_days' => $deliveryTimeSlots
    //     ]);
    // }

    // public function getWorkingDays(Request $request)
    // {
    //     $supportedLangs = ['en', 'ar'];
    //     $lang = in_array($request->header('lang'), $supportedLangs) ? $request->header('lang') : 'en';

    //     $nameColumn = 'name_' . $lang;
    //     // Fetch all work days with deliveries per day limit
    //     $deliveryTimeSlots = OrderWorkDay::where(['is_work_day' => 1])
    //         ->select('id', "$nameColumn as name_en", 'deliveries_per_day')
    //         ->get();

    //     // Fetch today's orders count grouped by day
    //     $todayOrders = Order::select(DB::raw('DAYNAME(created_at) as day_name'), DB::raw('count(*) as total_orders'))
    //         ->whereDate('created_at', Carbon::today())
    //         ->groupBy(DB::raw('DAYNAME(created_at)'))
    //         ->pluck('total_orders', 'day_name');

    //     // Filter days based on the orders count and deliveries per day
    //     $filteredDeliveryTimeSlots = $deliveryTimeSlots->filter(function ($day) use ($todayOrders) {
    //         $dayName = strtolower($day->name_en);
    //         $orderCount = $todayOrders->get($dayName, 0);
    //         return $orderCount < $day->deliveries_per_day;
    //     });

    //     return response()->json([
    //         'status' => 1,
    //         'message' => 'Success',
    //         'working_days' => $filteredDeliveryTimeSlots->values()
    //     ]);
    // }

    public function getWorkingDays(Request $request)
    {
        $supportedLangs = ['en', 'ar'];
        $lang = in_array($request->header('lang'), $supportedLangs) ? $request->header('lang') : 'en';

        $nameColumn = 'name_' . $lang;

        // Fetch all work days with deliveries per day limit
        $deliveryTimeSlots = OrderWorkDay::where(['is_work_day' => 1])
            ->select('id', "$nameColumn as name_en", 'deliveries_per_day', 'name_en as name') // keep name_en for matching
            ->get();

        // Fetch today's orders count grouped by day
        $todayOrders = Order::select(DB::raw('DAYNAME(created_at) as day_name'), DB::raw('count(*) as total_orders'))
            ->whereDate('created_at', Carbon::today())
            ->groupBy(DB::raw('DAYNAME(created_at)'))
            ->pluck('total_orders', 'day_name'); // keys like "Sunday", "Monday"

        // Filter days based on the orders count and deliveries per day
        $filteredDeliveryTimeSlots = $deliveryTimeSlots->filter(function ($day) use ($todayOrders) {
            // Normalize to match DAYNAME format (ucfirst English)
            $dayName = ucfirst(strtolower($day->name_en));
            $orderCount = $todayOrders->get($dayName, 0);
            return $orderCount < $day->deliveries_per_day;
        });

        return response()->json([
            'status' => 1,
            'message' => 'Success',
            'working_days' => $filteredDeliveryTimeSlots->values()
        ]);
    }

    public function getDaysTimeSlots(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'work_day_id' => 'required|exists:order_work_days,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        $deliveryTimeSlots = DeliveryTime::where(['order_work_day_id'=> $request->work_day_id, 'status'=>1])
            ->select('id','time_slot')
            ->get();

        return response()->json([
            'status'=>1,
            'message'=>'Success',
            'days_time_slots' => $deliveryTimeSlots,
        ]);
    }

    public function getDeliveryTypes(Request $request)
    {
        $supportedLangs = ['en', 'ar'];
        $lang = in_array($request->header('lang'), $supportedLangs) ? $request->header('lang') : 'en';
        $nameColumn = 'name_' . $lang;

        $delivery_types = DeliveryPackage::where(['status' => '1'])
            ->select('id', "$nameColumn as name",'price as delivery_charges','urgent_price as order_total')
            // ->select('id', 'name_en as name')
            ->get();


        return response()->json([
            'status' => 1,
            'message' => 'success',
            'delivery_types' => $delivery_types,
        ]);
    }
}
