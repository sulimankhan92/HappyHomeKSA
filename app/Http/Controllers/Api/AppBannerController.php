<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppBanner;
use Illuminate\Http\Request;

class AppBannerController extends Controller
{
    public function index()
    {
        $banners = AppBanner::where('status', '1')
            ->orderBy('order_number')
            ->select('id', 'image', 'order_number')
            ->get()
            ->map(function ($banner) {
                $banner->image = 'public/storage/app_banner/' . $banner->image;
                return $banner;
            });

        return response()->json([
            'banners' => $banners,
        ]);

    }
}
