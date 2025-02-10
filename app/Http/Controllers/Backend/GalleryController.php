<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Gallery;

use Carbon\Carbon;

class GalleryController extends Controller
{

    public function index()
    {
        $details = Gallery::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.gallery.index', compact('details'));
    }

    public function create(Request $request)
    { 
        return view('backend.gallery.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'calculation_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            
        ]);

        // Handle Banner Image upload
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/gallery/'), $bannerImageName);
        }

        // Handle Calculation Data
        $calculationImages = [];

        if ($request->hasFile('calculation_images')) {
            foreach ($request->file('calculation_images') as $index => $calculationImage) {
                if ($calculationImage->isValid()) {
                    $calculationImageName = time() . rand(10, 999) . '.' . $calculationImage->getClientOriginalExtension();
                    $calculationImage->move(public_path('uploads/gallery/'), $calculationImageName);
                    $calculationImages[] = $calculationImageName;
                }
            }
        }

        $maxCount = count($calculationImages);

        $calculationImages = array_pad($calculationImages, $maxCount, null);

        Gallery::create([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $bannerImageName ?? null,
            'gallery_images' => json_encode($calculationImages), 
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);


        return redirect()->route('gallery.index')->with('message', 'Details added successfully.');
    }

    public function edit($id)
    {
        $details = Gallery::findOrFail($id);
        $calculation_images = json_decode($details->gallery_images, true);
    
        return view('backend.gallery.edit', compact('details', 'calculation_images'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $details = Gallery::findOrFail($id);

        $validatedData = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'calculation_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle Banner Image Upload
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/gallery/'), $bannerImageName);

        } else {
            $bannerImageName = $details->banner_image;
        }

       
        $calculationImages = json_decode($details->calculation_images, true) ?? [];
    
        $deletedImages = json_decode($request->deleted_calculation_images, true);
        $deletedImages = is_array($deletedImages) ? $deletedImages : [];

        foreach ($deletedImages as $deletedImage) {
            if (($key = array_search($deletedImage, $calculationImages)) !== false) {
                unset($calculationImages[$key]); 

            }
        }

        $calculationImages = array_values($calculationImages);
    

        $existingImages = $request->existing_images ?? [];
        $calculationImages = $existingImages;
  
        // **Handle New Image Uploads**
        if ($request->hasFile('calculation_images')) {
            foreach ($request->file('calculation_images') as $calculationImage) {
                if ($calculationImage->isValid()) {
                    $calculationImageName = time() . rand(10, 999) . '.' . $calculationImage->getClientOriginalExtension();
                    $calculationImage->move(public_path('uploads/gallery/'), $calculationImageName);
                    $calculationImages[] = $calculationImageName; 
                }
            }
        }

        $maxCount = count($calculationImages);
        $calculationImages = array_slice(array_values($calculationImages), 0, $maxCount);

        $details->update([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $bannerImageName,
            'gallery_images' => json_encode($calculationImages),
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('gallery.index')->with('message', 'Details updated successfully.');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Gallery::findOrFail($id);
            $industries->update($data);

            return redirect()->route('gallery.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}