<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            'email' => 'required|email',
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

        $user->name = $validated['name'] ?? $user->name;
        $user->email = $validated['email'] ?? $user->email;
        $user->address = $validated['address'] ?? $user->address;
        $user->city = $validated['city'] ?? $user->city;
        $user->country = $validated['country'] ?? $user->country;
        $user->is_updated = 1;
        // $user->latitude = $validated['latitude'] ?? $user->latitude;
        // $user->longitude = $validated['longitude'] ?? $user->longitude;
        $user->save();

        return response()->json([
            'status'=>200,
            'message' => 'Profile updated successfully',
            'user' => $user
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

}
