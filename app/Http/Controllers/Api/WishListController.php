<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WishListController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if (!$wishlist) {
            $wishlist = Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
            ]);
            return response()->json(['status'=> 1,'message' => 'successfully added', 'wishlist' => $wishlist], 200);
        }else{
            $wishlist->delete();
            return response()->json(['status'=> 1, 'message' => 'Product removed from wishlist.'], 200);
        }

        return response()->json(['status'=> 0,'message' => 'Product not found', 'wishlist' => $wishlist], 200);
    }

    public function delete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=> 0,'message' => 'Validation Error', 'error' => $validator->errors()], 422);
        }

        // Check if the product already exists in the wishlist for the current user
        $existingWishlist = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingWishlist) {
            // Product already exists in wishlist, so delete it (toggle behavior)
            $existingWishlist->delete();
            return response()->json(['status'=> 1, 'message' => 'Product removed from wishlist.'], 200);
        }

        return response()->json(['status'=> 0, 'message' => 'item is not already wishlisted.'], 201);

    }

    public function index(Request $request)
    {
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->get();

        return response()->json(['status'=> 0,'message' => 'successfully added', 'wishlist' => $wishlist], 200);
    }
}
