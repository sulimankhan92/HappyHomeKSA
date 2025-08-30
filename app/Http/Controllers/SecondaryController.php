<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SecondaryCategoryRequest;
use App\Models\Category;
use App\Models\SecondaryCategory;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SecondaryController extends Controller
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
        $secondaryCategory = new SecondaryCategory();
        $categories = Category::where('status','1')->get();
        return view('secondaryCategory.create',compact('secondaryCategory','categories'));
    }

    public function store(SecondaryCategoryRequest $request)
    {
        $secondaryCategory = SecondaryCategory::create($request->all() + [
                'created_by'=>auth()->id(),
            ]);

        if ($request->hasFile('images')) {
            $uploadedImages = $this->imageUploadService->uploadMultipleImages($request->file('images'), 'secondary_category');

            // You can now store these paths in the database as needed
            foreach ($uploadedImages as $imagePath) {
                $fileName = basename($imagePath);
                $secondaryCategory->secondaryCategoryImages()->create(['images' => $fileName]);
            }
        }

        return redirect()->back()->with('success', 'Secondary Category created successfully.');
//        return redirect('categories/'.$category->id)->with('success', 'Category created successfully.');
    }

    public function edit($secondaryCategory)
    {
        $secondaryCategory = SecondaryCategory::with(['secondaryCategoryImages'])->findOrFail($secondaryCategory);
        $categories = Category::where('status','1')->get();
        return view('secondaryCategory.edit', compact('secondaryCategory','categories'));
    }

    public function update(SecondaryCategoryRequest $request, SecondaryCategory $secondaryCategory)
    {
        $secondaryCategory->update($request->all());

        if ($request->hasFile('images')) {
            $uploadedImages = $this->imageUploadService->uploadMultipleImages($request->file('images'), 'secondary_category');

            // You can now store these paths in the database as needed
            foreach ($uploadedImages as $imagePath) {
                $fileName = basename($imagePath);
                $secondaryCategory->secondaryCategoryImages()->create(['images' => $fileName] + [
                        'created_by'=>auth()->id(),
                    ]);
            }
        }

        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = $secondaryCategory->secondaryCategoryImages()->findOrFail($imageId);
                // Delete image from storage
                Storage::disk('public')->delete('secondary_category/' . $image->file_name);

                // Delete image record from database
                $image->delete();
            }
        }
        return redirect()->back()->with('success', 'Secondary Category created successfully.');

//        return redirect()->route('secondary-categories.index')->with('success', 'Category updated successfully!');
    }

}
