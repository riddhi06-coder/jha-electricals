<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\SubCategory;
use App\Models\Category;


class SubCategoryController extends Controller
{

    public function index()
    {
        // $sub_categories = SubCategory::whereNull('deleted_by')->get();
        $sub_categories = SubCategory::whereNull('deleted_by')->with('category')->get()->groupBy('category.category_name');

        return view('backend.sub-category.index', compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::whereNull('deleted_by')->get();
        return view('backend.sub-category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:master_category,id',
            'sub_category_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'category_id.required' => 'The category selection is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'sub_category_name.required' => 'The subcategory name is required.',
            'sub_category_name.string' => 'The subcategory name must be a valid string.',
            'sub_category_name.max' => 'The subcategory name must not exceed 255 characters.',
            'image.required' => 'The image is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'Only .jpg, .jpeg, .png, and .webp formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);
    
        $slug = Str::slug($request->sub_category_name, '-');
    
      
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image'); 
    
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;
    
                $destinationPath = public_path('/uploads/sub-category/');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
    
                $image->move($destinationPath, $new_name);
    
                $imagePath = $new_name; 
            }
        }
    
        SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'slug' => $slug,
            'image' => $imagePath,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);
    
        return redirect()->route('sub-category.index')->with('message', 'Sub Category created successfully.');
    }
    
    
    

}