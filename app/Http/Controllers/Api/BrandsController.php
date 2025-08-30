<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandsController extends Controller
{
    public function getBrands(Request $request)
    {
        $limit = $request->get('limit', 20);
        $page = $request->get('page', 10);
        // Calculate offset
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en'); // Default to English
        $nameColumn = ($lang === 'ar') ? 'name_ar' : 'name'; // Use name_ar for Arabic, otherwise name (English)

        $brands = DB::table('product_brands')
            ->select([
                'id',
                DB::raw("COALESCE($nameColumn, name) as name"), // Fallback to English if Arabic is null
                'logo'
            ])
            ->where('status', '1')
            ->limit($limit)
            ->offset($offset)
            ->get()
            ->map(function ($brand) {
                $brand->logo = !empty($brand->logo)
                    ? 'public/storage/brands/' . $brand->logo
                    : 'public/storage/brands/YpAwAhjgznyNEAd4m5o3cLycuf1po6jIHXF4ki8c.webp';

                return $brand;
            });

        $totalBrands = DB::table('product_brands')->where(['status' => '1'])->count();

        return response()->json([
            'total_brands_count' => $totalBrands,
            'brands' => $brands,
        ]);

    }
}
