<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponAssignedUser;
use App\Models\CouponUser;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function verifyCoupon(Request $request)
    {
        $couponCode = $request->input('code');

        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 200);
        }

        // Find the coupon by code
        $coupon = Coupon::where('code', $couponCode)->first();

        if (!$coupon) {
            return response()->json([
                'status' => 0,
                'message' => 'Coupon not found.',
            ], 200);
        }

        // Check if the coupon is active and not expired
        if ($coupon->is_active != 1) {
            return response()->json([
                'status' => 0,
                'message' => 'Coupon is not active.',
            ], 200);
        }

        if ($coupon->start_date && Carbon::now()->lessThan(Carbon::parse($coupon->start_date))) {
            return response()->json([
                'status' => 0,
                'message' => 'Coupon is not yet valid.',
            ], 200);
        }

        if ($coupon->end_date && Carbon::now()->greaterThan(Carbon::parse($coupon->end_date))) {
            return response()->json([
                'status' => 0,
                'message' => 'Coupon has expired.',
            ], 200);
        }

        $userId = Auth::id();

        // Check in coupon_usage is coupon used table
        $couponUsageCount = CouponUser::where('coupon_id', $coupon->id)
            ->where('user_id', $userId)
            ->count();

        if ($couponUsageCount>0 && $couponUsageCount >= $coupon->coupon_use_counts) {
            return response()->json([
                'status' => 0,
                'message' => 'You are not eligible to use this coupon.',
            ], 200);
        }

        if ($coupon->coupon_category == 'FIRST_TIME_ORDER') {
            $couponOrderCount = Order::where('customer_id', $userId)
                ->count();

            if ($couponOrderCount>0) {
                return response()->json([
                    'status' => 0,
                    'message' => 'You are not eligible to use this coupon.',
                ], 200);
            }
        }

        if ($coupon->is_for_all_users == 3) {
            $couponIsAssignedCount = CouponAssignedUser::where([
                'user_id'=> $userId,
                'coupon_id'=> $coupon->id,
                'is_active'=> 1,
            ])->count();

            if ($couponIsAssignedCount>0) {
                return response()->json([
                    'status' => 0,
                    'message' => 'You are not eligible to use this coupon.',
                ], 200);
            }
        }

        // Prepare coupon details
        $couponDetails = [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'category' => $coupon->coupon_category,
            'amount' => $coupon->type === 'FIXED_AMOUNT' ? $coupon->amount : 0,
            'percentage' => $coupon->type === 'PERCENTAGE' ? $coupon->percentage : 0,
            'start_date' => $coupon->start_date,
            'end_date' => $coupon->end_date,
        ];

        // Return success response with coupon details
        return response()->json([
            'status' => 1,
            'message' => 'Coupon is valid.',
            'data' => $couponDetails,
        ]);
    }
}
