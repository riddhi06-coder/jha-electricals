<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ProductVisionRange;


use Carbon\Carbon;

class VisionControllerController extends Controller
{

    public function index()
    {
        $product = ProductVisionRange::orderBy('id', 'desc')->whereNull('deleted_by')->first();  
        return view('backend.about.vision.index', compact('product'));
    }
    

    public function create(Request $request)
    { 
        return view('backend.about.vision.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_titles.*' => 'required|string|max:255',
            'product_descriptions.*' => 'required|string',
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        // Handle Product Images Upload
        $productImages = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = time() . rand(10, 999) . '.' . $extension;
                    $filePath = public_path('uploads/about/product-range/');
    
                    if (!file_exists($filePath)) {
                        mkdir($filePath, 0777, true);
                    }
    
                    $image->move($filePath, $fileName);
                    $productImages[] = $fileName;
                }
            }
        }
    
        // Handle Vision Image Upload
        $visionImagePath = null;
        if ($request->hasFile('vision_image')) {
            $visionImage = $request->file('vision_image');
            if ($visionImage->isValid()) {
                $extension = $visionImage->getClientOriginalExtension();
                $fileName = time() . rand(10, 999) . '.' . $extension;
                $filePath = public_path('uploads/about/product-vision/');
    
                if (!file_exists($filePath)) {
                    mkdir($filePath, 0777, true);
                }
    
                $visionImage->move($filePath, $fileName);
                $visionImagePath = $fileName;
            }
        }
    
        // Prepare product data to store in separate columns
        $productData = [
            'product_images' => $productImages,
            'product_titles' => $request->product_titles,
            'product_descriptions' => $request->product_descriptions,
        ];
    
        // Save the data in separate columns
        $productVisionRange = new ProductVisionRange();
        $productVisionRange->product_title = $request->product_title;
        $productVisionRange->product_description = $request->product_description;
        $productVisionRange->product_images = json_encode($productData['product_images']);
        $productVisionRange->product_titles = json_encode($productData['product_titles']);
        $productVisionRange->product_descriptions = json_encode($productData['product_descriptions']);
        $productVisionRange->vision_title = $request->vision_title;
        $productVisionRange->vision_description = $request->vision_description;
        $productVisionRange->vision_image = $visionImagePath;
        $productVisionRange->inserted_at = Carbon::now();
        $productVisionRange->inserted_by = Auth::id();
        $productVisionRange->save();
    
        return redirect()->route('product-vision.index')->with('message', 'Data saved successfully.');
    }
    
    
    public function edit($id)
    {
        $range = ProductVisionRange::findOrFail($id);
        return view('backend.about.vision.edit', compact('range'));
    }

    public function update(Request $request, $id)
    {
        dd($request);
        // Find the existing ProductVisionRange by ID
        $productVisionRange = ProductVisionRange::findOrFail($id);

        // Validate the request data
        $validatedData = $request->validate([
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_titles.*' => 'required|string|max:255',
            'product_descriptions.*' => 'required|string',
            'vision_title' => 'required|string|max:255',
            'vision_description' => 'required|string',
            'vision_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'product_title.required' => 'The product title is required.',
            'product_description.required' => 'The product description is required.',
            'product_images.*.image' => 'Each product image must be a valid image file.',
            'product_images.*.mimes' => 'Product images must be in JPG, JPEG, PNG, or WEBP format.',
            'product_images.*.max' => 'Each product image must be less than 2MB.',
            'product_titles.*.required' => 'Each product title is required.',
            'product_descriptions.*.required' => 'Each product description is required.',
            'vision_title.required' => 'The vision title is required.',
            'vision_description.required' => 'The vision description is required.',
            'vision_image.image' => 'The vision image must be a valid image file.',
            'vision_image.mimes' => 'The vision image must be in JPG, JPEG, PNG, or WEBP format.',
            'vision_image.max' => 'The vision image must be less than 2MB.',
        ]);

        // Handle Product Images Upload
        $productImages = json_decode($productVisionRange->product_image, true) ?? [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = time() . rand(10, 999) . '.' . $extension;
                    $filePath = public_path('uploads/about/product-range/');

                    if (!file_exists($filePath)) {
                        mkdir($filePath, 0777, true);
                    }

                    $image->move($filePath, $fileName);
                    $productImages[] = $fileName;
                }
            }
        }

        // Handle Vision Image Upload (if updated)
        $visionImagePath = $productVisionRange->vision_image;
        if ($request->hasFile('vision_image')) {
            $visionImage = $request->file('vision_image');
            if ($visionImage->isValid()) {
                $extension = $visionImage->getClientOriginalExtension();
                $fileName = time() . rand(10, 999) . '.' . $extension;
                $filePath = public_path('uploads/about/product-vision/');

                if (!file_exists($filePath)) {
                    mkdir($filePath, 0777, true);
                }

                // Delete old vision image if exists
                if ($visionImagePath && file_exists(public_path('uploads/about/product-vision/' . $visionImagePath))) {
                    unlink(public_path('uploads/about/product-vision/' . $visionImagePath));
                }

                $visionImage->move($filePath, $fileName);
                $visionImagePath = $fileName;
            }
        }

        // Prepare product data to store as JSON
        $productData = [];
        foreach ($productImages as $key => $imagePath) {
            $productData[] = [
                'product_image' => $imagePath,
                'product_title_detail' => $request->product_titles[$key],
                'product_description_detail' => $request->product_descriptions[$key],
            ];
        }

        $combinedData = [
            'vision_title' => $request->vision_title,
            'vision_description' => $request->vision_description,
            'vision_image' => $visionImagePath,
            'product_title' => $request->product_title,
            'product_description_detail' => $request->product_description,
            'product_image' => json_encode($productData),
            'product_title_detail' => json_encode(array_column($productData, 'product_title_detail')),
        ];

        // Update the ProductVisionRange with the new data
        $productVisionRange->update([
            'vision_title' => $combinedData['vision_title'],
            'vision_description' => $combinedData['vision_description'],
            'vision_image' => $combinedData['vision_image'],
            'product_title' => $combinedData['product_title'],
            'product_description_detail' => $combinedData['product_description_detail'],
            'product_image' => $combinedData['product_image'],
            'product_title_detail' => $combinedData['product_title_detail'],
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('product-vision.index')->with('message', 'Data updated successfully.');
    }


}