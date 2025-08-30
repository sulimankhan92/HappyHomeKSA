<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponAssignedUserRequest;
use App\Models\Coupon;
use App\Models\CouponAssignedUser;
use App\Models\User;
use Illuminate\Http\Request;

class CouponAssignedUserController extends Controller
{
    public function create()
    {
        $coupons_assigned_user = new CouponAssignedUser();
        $is_active = CouponAssignedUser::getIsActiveOptions();
//        $categories  = Coupon::getCouponCategory();
//        $types  = Coupon::getCouponType();
        return view('coupon-assigned.create', compact('coupons_assigned_user','is_active'));
    }

    public function store(CouponAssignedUserRequest $request)
    {
        $coupons = CouponAssignedUser::create($request->all() + [
                'created_by' => auth()->id(),
                'assigned_by_user_id' => auth()->id(),
                'status' => 1
            ]);
//        return redirect()->route('coupon-assigned-users.index')->with('success', 'coupons is updated successfully!');
        return redirect()->back()->with('success', 'Coupon is created successfully.');
    }

    public function edit($coupon)
    {
        $coupons_assigned_user = CouponAssignedUser::findOrFail($coupon);
        $is_active = CouponAssignedUser::getIsActiveOptions();
        $selectedUser = User::find($coupons_assigned_user->user_id);
        $selectedCoupon = Coupon::find($coupons_assigned_user->coupon_id);
        return view('coupon-assigned.edit', compact('coupons_assigned_user','is_active','selectedUser','selectedCoupon'));
    }

    public function update(CouponAssignedUserRequest $request, CouponAssignedUser $coupons_assigned_user)
    {
        $coupons_assigned_user->update($request->all() + [
                'updated_by'=>auth()->id(),
            ]);

        return redirect()->route('coupon-assigned-users.index')->with('success', 'coupons is updated successfully!');
    }

    public function search_coupon(Request $request)
    {
        $term = $request->get('query', ''); // Fetch the 'query' parameter

        $coupons = Coupon::where('code', 'like', "%{$term}%")
            ->where('is_for_all_users', 3)
            ->orWhere('title_en', 'like', "%{$term}%")
            ->limit(10)
            ->get();

        return response()->json([
            'coupons' => $coupons->map(function ($coupon) {
                return [
                    'id' => $coupon->id,
                    'name' => $coupon->title_en,
                ];
            }),
        ]);
    }
}
