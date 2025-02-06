<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ChooseUs;


use Carbon\Carbon;

class ChooseControllerController extends Controller
{

    public function index()
    {
        return view('backend.about.choose.index');
    }
    

    public function create(Request $request)
    { 
        return view('backend.about.choose.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_titles.*' => 'required|string|max:255',
            'product_descriptions.*' => 'required|string',
        ], [
            'product_title.required' => 'The product title is required.',
            'product_description.required' => 'The product description is required.',
            'product_images.*.nullable' => 'The product image is optional, but if provided, it must be an image.',
            'product_images.*.image' => 'The product image must be an image.',
            'product_images.*.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for images.',
            'product_images.*.max' => 'The image must be less than 2MB.',
            'product_titles.*.required' => 'Each product title is required.',
            'product_descriptions.*.required' => 'Each product description is required.',
        ]);
    
        // Handle product image uploads
        $productImages = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                if ($image->isValid()) {
                    $imageExtension = $image->getClientOriginalExtension();
                    $imageName = time() . rand(10, 999) . '.' . $imageExtension;
                    $imagePath = public_path('uploads/choose-us/');
    
                    if (!file_exists($imagePath)) {
                        mkdir($imagePath, 0777, true);
                    }
    
                    $image->move($imagePath, $imageName);
                    $productImages[] = $imageName;
                }
            }
        }
    
        $productTitles = $request->product_titles;
        $productDescriptions = $request->product_descriptions;
    
        $chooseUs = new ChooseUs();
        $chooseUs->product_title = $request->product_title;
        $chooseUs->product_description = $request->product_description;
        $chooseUs->product_images = json_encode($productImages); 
        $chooseUs->product_titles = json_encode($productTitles); 
        $chooseUs->product_descriptions = json_encode($productDescriptions); 
        $chooseUs->inserted_at = Carbon::now();
        $chooseUs->inserted_by = Auth::id();
        $chooseUs->save();
    
        return redirect()->route('choose-us.index')->with('message', 'Data saved successfully.');
    }
    

}