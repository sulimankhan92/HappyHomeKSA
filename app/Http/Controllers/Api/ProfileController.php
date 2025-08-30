<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageUploadService;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'=> 422,
                'message' => 'Please fill out all fields',
                'error' => $validator->errors()
            ], 422);
        }

        $user = Auth::user();

        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->address = $request->address ?? $user->address;
        $user->city = $request->city ?? $user->city;
        $user->country = $request->country ?? $user->country;
        $user->is_updated = 1;
        $user->save();

        $address = UserAddress::where(['user_id' =>  Auth::id(), 'status'=>1 ,'is_select' => 1])->first();

        if (!$address)
        {
            $address = UserAddress::create([
                'user_id' =>  Auth::id(),
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'city' => $request->city,
                'type' => 'home',
                'is_select' => 1,
                'status' => 1,
                'is_default' => 1,
            ]);
        }else {
            $address->update([
                'address' => $request->address,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude, // corrected: used to be latitude
                'city' => $request->city,
            ]);
        }

        $user->name = $user->name ?? "";
        $user->email = $user->email ?? "";
        $user->email_verified_at = $user->email_verified_at ?? "";
        $user->otp = $user->otp ?? "";
        $user->address = $user->address ?? "";
        $user->city = $user->city ?? "";
        $user->country = $user->country ?? "";
        $user->profile_image = !empty($user->profile_image)
            ? 'public/storage/profile_image/' . $user->profile_image
            : '';

        return response()->json([
            'status'=>200,
            'message' => 'Profile updated successfully',
            'user' => $user,
            'delivery_address' => $address ?? [],
        ], 200);
    }

    public function updateProfilePicture(Request $request){

        if ($request->hasFile('profile_image')) {
            $profileImage = [$request->file('profile_image')];
            $uploadedImages = $this->imageUploadService->uploadMultipleImages($profileImage, 'profile_image');

            $user = Auth::user();

            foreach ($uploadedImages as $imagePath) {
                $fileName = basename($imagePath);
                $user->profile_image = $fileName;
                $user->save();
            }

            $user->name = $user->name ?? "";
            $user->email = $user->email ?? "";
            $user->email_verified_at = $user->email_verified_at ?? "";
            $user->otp = $user->otp ?? "";
            $user->address = $user->address ?? "";
            $user->city = $user->city ?? "";
            $user->country = $user->country ?? "";
            $user->profile_image = !empty($user->profile_image)
                ? 'public/storage/profile_image/' . $user->profile_image
                : '';

            return response()->json([
                'status' => 200,
                'message' => 'Profile updated successfully',
                'user' => $user
            ], 200);
        }

        return response()->json([
            'status'=> 422,
            'message' => 'Profile image file is required',
        ], 400);
    }

    public function userWalletPoints(Request $request)
    {
        $user = $request->user();

        return response()->json([
            'status' => 200,
            'message' => 'User Wallet Pointsy',
            'wallet_points' => $user->wallet_balance,
        ], 200);
    }
}
