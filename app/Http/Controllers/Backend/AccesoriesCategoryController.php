<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\AccessoriesCategory;
use Carbon\Carbon;


class AccesoriesCategoryController extends Controller
{

    public function index()
    {
        $categories = AccessoriesCategory::whereNull('deleted_by')->get(); 
        return view('backend.product.accessories.category.index', compact('categories'));
    }

    public function create(Request $request)
    { 
        return view('backend.product.accessories.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'nullable|string|max:255',
            'category_name' => 'required|string|max:255|unique:product_category,category_name',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'category_name.required' => 'The category name is required.',
            'category_name.string' => 'The category name must be a valid string.',
            'category_name.max' => 'The category name must not exceed 255 characters.',
            'category_name.unique' => 'This category name is already taken. Please choose another.',
    
            'heading.string' => 'The heading must be a valid string.',
            'heading.max' => 'The heading must not exceed 255 characters.',
    
            'image.required' => 'Please upload an image for the category.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);
    

        $slug = Str::slug($request->category_name, '-');
    
       $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image'); 
    
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;
    
                $destinationPath = public_path('/uploads/products/');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
    
                $image->move($destinationPath, $new_name);
    
                $imagePath = $new_name; 
            }
        }
    
        AccessoriesCategory::create([
            'heading' => $request->heading,
            'category_name' => $request->category_name,
            'slug' => $slug,
            'image' => $imagePath, 
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(), 
        ]);
    
        return redirect()->route('accessories-product-category.index')->with('message', 'Accessories category created successfully.');
    }
}