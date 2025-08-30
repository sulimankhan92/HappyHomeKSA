<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductBrandRequest;
use App\Models\ProductBrand;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }

    public function create()
    {
        $brand = new ProductBrand();
        return view('brands.create',compact('brand'));
    }

    public function store(ProductBrandRequest $request)
    {
        $brand = ProductBrand::create($request->all() + [
                'created_by'=>auth()->id(),
            ]);

        if ($request->hasFile('images')) {
            $uploadedImages = $this->imageUploadService->uploadMultipleImages($request->file('images'), 'brands');

            foreach ($uploadedImages as $imagePath) {
                $fileName = basename($imagePath);
                $brand->logo = $fileName;
                $brand->save();
            }
        }

        return redirect()->back()->with('success', 'Product Brand created successfully.');
    }

    public function edit($brand)
    {
        $brand = ProductBrand::findOrFail($brand);
        return view('brands.edit', compact('brand'));
    }

    public function update(ProductBrandRequest $request, ProductBrand $brand)
    {


        if ($request->hasFile('images')) {
            $uploadedImages = $this->imageUploadService->uploadMultipleImages($request->file('images'), 'brands');

            foreach ($uploadedImages as $imagePath) {
                $fileName = basename($imagePath);
                $brand->logo = $fileName;
            }
        }
        $brand->update($request->all() + [
                'created_by'=>auth()->id(),
            ]);

//        if ($request->has('images')) {
//            foreach ($request->remove_images as $imageId) {
//                $image = $category->categoryImages()->findOrFail($imageId);
//                // Delete image from storage
//                Storage::disk('public')->delete('products/' . $image->file_name);
//
//                // Delete image record from database
//                $image->delete();
//            }
//        }

        return redirect()->route('product-brands.index')->with('success', 'Product brand updated successfully!');
    }
}
