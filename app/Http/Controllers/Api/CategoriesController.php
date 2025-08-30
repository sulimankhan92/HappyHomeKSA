<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function getCategories(Request $request)
    {
        $limit = $request->get('limit', 200);
        $page = $request->get('page', 1);
        $offset = ($page - 1) * $limit;
        $lang = $request->header('lang', 'en');

        $categories = Category::with('image')
            ->where(['status' => '1'])
            ->select(['id', 'name_en', 'name_ar', 'detail_en', 'detail_ar','gb_color','text_color'])
            ->orderBy('order', 'asc')
            ->limit($limit)
            ->offset($offset)
            ->get();

        $categories = $categories->map(function ($category) use ($lang) {
            return [
                'id' => $category->id,
                'name_en' => ($lang === 'ar') ? $category->name_ar : $category->name_en,
                'name_ar' => $category->name_ar,
                'detail_en' => ($lang === 'ar') ? $category->detail_ar : $category->detail_en,
                'detail_ar' => $category->detail_ar,
                'gb_color' => $category->gb_color,
                'text_color' =>$category->text_color,
                'file_name' => isset($category->image) ? 'public/storage/category/' . $category->image->file_name : 'storage/category/default-image.jpg',
            ];
        });

        $totalCategories = Category::where(['status' => '1'])->count();

        return response()->json([
            'total_categories_count' => $totalCategories, // Add total category count
            'categories' => $categories,
        ]);
        // Return the paginated results as JSON
        // return response()->json($categories);
    }
}
