<?php

namespace App\Http\Controllers;

use App\Models\AppBanner;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppBannerController extends Controller
{

    protected $imageUploadService;

    public function __construct(ImageUploadService $imageUploadService)
    {
        $this->imageUploadService = $imageUploadService;
    }
    // Display a listing of the banners
    public function index()
    {
        $banners = AppBanner::orderBy('order_number')->paginate(50);
        return view('banners.index', compact('banners'));
    }

    // Show the form for creating a new banner
    public function create()
    {
        return view('banners.create');
    }

    // Store a newly created banner in the database
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|int',
            'order_number' => 'required|int',
        ]);

        if ($request->hasFile('image')) {
            $AppBannerImage = [$request->file('image')];
            $uploadedImages = $this->imageUploadService->uploadMultipleImages($AppBannerImage, 'app_banner');

            $user = Auth::user();
            $fileName = '';
            foreach ($uploadedImages as $imagePath) {
                $fileName = basename($imagePath);
            }
        }

        AppBanner::create([
            'image' => $fileName,
            'order_number' => $request->order_number,
            'status' => $request->status,
        ]);

        return redirect()->route('banners.index')->with('success', 'Banner created successfully.');
    }

    // Display the specified banner
    public function show(AppBanner $banner)
    {
        return view('banners.show', compact('banner'));
    }

    // Show the form for editing the specified banner
    public function edit(AppBanner $banner)
    {
        return view('banners.edit', compact('banner'));
    }

    // Update the specified banner in the database
    public function update(Request $request, AppBanner $banner)
    {

        $request->validate([
            'status' => 'required|int',
            'order_number' => 'required|int',
        ]);

        if ($request->hasFile('image')) {
            $AppBannerImage = [$request->file('image')];
            $uploadedImages = $this->imageUploadService->uploadMultipleImages($AppBannerImage, 'app_banner');

            $user = Auth::user();
            $fileName = '';
            foreach ($uploadedImages as $imagePath) {
                $fileName = basename($imagePath);
            }

            $banner->image = $fileName;
        }

        $banner->order_number = $request->order_number;
//            $banner->created_by_id = $user->id;
        $banner->status = $request->status;
        $banner->save();
        return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
    }

    // Remove the specified banner from the database
    public function destroy(AppBanner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
    }
}
