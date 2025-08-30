<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

//    public function index()
//    {
//        $products = Product::all();
//        $secondaryCategory = SecondaryCategory::all();
//        $productManufacturer = ProductManufacturer::all();
//        $supplier = Supplier::all();
//
//        return view('products.index', compact('products'));
//    }

    public function create()
    {
        $category = new Category();
        return view('category.create',compact('category'));
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all() + [
                'created_by'=>auth()->id(),
            ]);

        if ($request->hasFile('images')) {
            $uploadedImages = $this->imageUploadService->uploadMultipleImages($request->file('images'), 'category');
            // You can now store these paths in the database as needed
            foreach ($uploadedImages as $imagePath) {
                $fileName = basename($imagePath);
                $category->logo = $fileName;
            }
        }

        return redirect()->back()->with('success', 'Category created successfully.');
//        return redirect('categories/'.$category->id)->with('success', 'Category created successfully.');
    }

    public function edit($category)
    {
        $category = Category::with(['categoryImages'])->findOrFail($category);
        return view('category.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        if ($request->hasFile('images')) {
            if ($request->hasFile('images')) {
                $uploadedImages = $this->imageUploadService->uploadMultipleImages($request->file('images'), 'category');

                // You can now store these paths in the database as needed
                foreach ($uploadedImages as $imagePath) {
                    $fileName = basename($imagePath);
                    $category->categoryImages()->create(['file_name' => $fileName]);
                }
            }
        }

        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = $category->categoryImages()->findOrFail($imageId);
                // Delete image from storage
                Storage::disk('public')->delete('products/' . $image->file_name);

                // Delete image record from database
                $image->delete();
            }
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

//    public function destroy(Product $product)
//    {
//        $product->delete();
//        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
//    }
}
