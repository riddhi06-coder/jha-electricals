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
        ], [
            // Custom validation messages
            'product_title.required' => 'The product title is required.',
            'product_title.string' => 'The product title must be a string.',
            'product_title.max' => 'The product title may not be greater than 255 characters.',
            
            'product_description.required' => 'The product description is required.',
            'product_description.string' => 'The product description must be a string.',
            
            'product_images.*.nullable' => 'The product image is optional, but if provided, it must be an image.',
            'product_images.*.image' => 'The product image must be an image.',
            'product_images.*.mimes' => 'The product image must be a file of type: jpg, jpeg, png, or webp.',
            'product_images.*.max' => 'The product image may not be greater than 2MB.',
            
            'product_titles.*.required' => 'The product title for each entry is required.',
            'product_titles.*.string' => 'Each product title must be a string.',
            'product_titles.*.max' => 'Each product title may not be greater than 255 characters.',
            
            'product_descriptions.*.required' => 'The product description for each entry is required.',
            'product_descriptions.*.string' => 'Each product description must be a string.',
            
            'vision_title.required' => 'The vision title is required.',
            'vision_title.string' => 'The vision title must be a string.',
            'vision_title.max' => 'The vision title may not be greater than 255 characters.',
            
            'vision_description.required' => 'The vision description is required.',
            'vision_description.string' => 'The vision description must be a string.',
            
            'vision_image.nullable' => 'The vision image is optional, but if provided, it must be an image.',
            'vision_image.image' => 'The vision image must be an image.',
            'vision_image.mimes' => 'The vision image must be a file of type: jpg, jpeg, png, or webp.',
            'vision_image.max' => 'The vision image may not be greater than 2MB.',
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
        $range = ProductVisionRange::findOrFail($id);
        
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
            'product_title.string' => 'The product title must be a string.',
            'product_title.max' => 'The product title may not be greater than 255 characters.',
            
            'product_description.required' => 'The product description is required.',
            'product_description.string' => 'The product description must be a string.',
            
            'product_images.*.nullable' => 'The product image is optional, but if provided, it must be an image.',
            'product_images.*.image' => 'The product image must be an image.',
            'product_images.*.mimes' => 'The product image must be a file of type: jpg, jpeg, png, or webp.',
            'product_images.*.max' => 'The product image may not be greater than 2MB.',
            
            'product_titles.*.required' => 'The product title for each entry is required.',
            'product_titles.*.string' => 'Each product title must be a string.',
            'product_titles.*.max' => 'Each product title may not be greater than 255 characters.',
            
            'product_descriptions.*.required' => 'The product description for each entry is required.',
            'product_descriptions.*.string' => 'Each product description must be a string.',
            
            'vision_title.required' => 'The vision title is required.',
            'vision_title.string' => 'The vision title must be a string.',
            'vision_title.max' => 'The vision title may not be greater than 255 characters.',
            
            'vision_description.required' => 'The vision description is required.',
            'vision_description.string' => 'The vision description must be a string.',
            
            'vision_image.nullable' => 'The vision image is optional, but if provided, it must be an image.',
            'vision_image.image' => 'The vision image must be an image.',
            'vision_image.mimes' => 'The vision image must be a file of type: jpg, jpeg, png, or webp.',
            'vision_image.max' => 'The vision image may not be greater than 2MB.',
        ]);
    
        // Handle Product Images Upload
        $productImages = json_decode($range->product_images, true) ?? [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $index => $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $fileName = time() . rand(10, 999) . '.' . $extension;
                    $filePath = public_path('uploads/about/product-range/');
                    
                    if (!file_exists($filePath)) {
                        mkdir($filePath, 0777, true);
                    }
                    
                    $image->move($filePath, $fileName);
                    $productImages[$index] = $fileName;
                }
            }
        }
    
        // Handle Vision Image Upload
        $visionImagePath = $range->vision_image;
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
    
        $productData = [
            'product_images' => $productImages,
            'product_titles' => $request->product_titles,
            'product_descriptions' => $request->product_descriptions,
        ];
    
        $range->product_title = $request->product_title;
        $range->product_description = $request->product_description;
        $range->product_images = json_encode($productData['product_images']);
        $range->product_titles = json_encode($productData['product_titles']);
        $range->product_descriptions = json_encode($productData['product_descriptions']);
        $range->vision_title = $request->vision_title;
        $range->vision_description = $request->vision_description;
        $range->vision_image = $visionImagePath;
        $range->modified_at = Carbon::now();
        $range->modified_by = Auth::id();
        $range->save();
    
        return redirect()->route('product-vision.index')->with('message', 'Data updated successfully.');
    }
    


    


}