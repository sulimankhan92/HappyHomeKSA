<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Http\Requests\CouponUpdateRequest;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function create()
    {
        $coupons = new Coupon();
        $is_active = Coupon::getIsActiveOptions();
        $categories  = Coupon::getCouponCategory();
        $types  = Coupon::getCouponType();
        return view('coupons.create', compact('coupons', 'is_active','categories', 'types'));
    }

    public function store(CouponRequest $request)
    {
        $coupons = Coupon::create($request->all() + [
                'created_by' => auth()->id(),
                'status' => 1
            ]);

        return redirect()->back()->with('success', 'Coupon is created successfully.');
    }

    public function edit($coupon)
    {
        $coupons = Coupon::findOrFail($coupon);
        $is_active = Coupon::getIsActiveOptions();
        $categories  = Coupon::getCouponCategory();
        $types  = Coupon::getCouponType();
        return view('coupons.edit', compact('coupons', 'is_active','categories', 'types'));
    }

    public function update(CouponUpdateRequest $request, Coupon $coupon)
    {
        $coupon->update($request->all() + [
                'updated_by'=>auth()->id(),
            ]);

        return redirect()->route('coupons.index')->with('success', 'coupons is updated successfully!');
    }

    public function search_user(Request $request)
    {
        $term = $request->get('query', ''); // Fetch the 'query' parameter

        $users = User::where('name', 'like', "%{$term}%")
            ->limit(10)
            ->get();

        return response()->json([
            'users' => $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                ];
            }),
        ]);
    }
}
