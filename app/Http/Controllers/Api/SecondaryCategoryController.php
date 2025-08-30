<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SecondaryCategory;
use Illuminate\Http\Request;

class SecondaryCategoryController extends Controller
{
    public function getSecondaryCategories(Request $request)
    {
        $lang = $request->header('lang', 'en');

        $categories = SecondaryCategory::where(['status' => '1', 'category_id' => $request->category_id])
            ->select(['id', 'category_id', 'name_en', 'name_ar', 'detail_en', 'detail_ar'])
            ->get();

        $categories = $categories->map(function ($category) use ($lang) {
            return [
                'id' => $category->id,
                'category_id' => $category->category_id,
                'name_en' => ($lang === 'ar') ? $category->name_ar : $category->name_en, // Dynamic name based on 'lang'
                'name_ar' => ($lang === 'ar') ? $category->name_ar : $category->name_en, // Dynamic name based on 'lang'
                'detail_en' => ($lang === 'ar') ? $category->detail_ar : $category->detail_en, // Dynamic detail based on 'lang'
                'detail_ar' => ($lang === 'ar') ? $category->detail_ar : $category->detail_en, // Dynamic detail based on 'lang'
            ];
        });

        return response()->json($categories);
    }
}
