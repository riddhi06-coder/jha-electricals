<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MasterProduct;

use Carbon\Carbon;


class MasterProductController extends Controller
{

    public function index()
    {
        $products = MasterProduct::with(['category', 'subcategory'])->whereNull('deleted_by')->get();
        return view('backend.products.index', compact('products'));
    }


    public function getSubcategories(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)
                        ->whereNull('deleted_by')
                        ->get();
        return response()->json(['subcategories' => $subcategories]);
    }


    public function create()
    { 
        $categories = Category::whereNull('deleted_by')->get();
        return view('backend.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:master_category,id',
            'sub_category_id' => 'required|exists:master_sub_category,id',
            'product_name' => [
                            'required',
                            'string',
                            'max:255',
                            Rule::unique('master_products', 'product_name')->whereNull('deleted_by')
                        ],

            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'category_id.required' => 'Please select a product category.',
            'category_id.exists' => 'The selected category does not exist.',

            'sub_category_id.required' => 'Please select a product subcategory.',
            'sub_category_id.exists' => 'The selected subcategory does not exist.',

            'product_name.required' => 'The product name is required.',
            'product_name.string' => 'The product name must be a valid string.',
            'product_name.max' => 'The product name must not exceed 255 characters.',
            'product_name.unique' => 'This product name is already taken. Please choose another.',

            'image.required' => 'Please upload an image for the product.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        $slug = Str::slug($request->product_name, '-');

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

        MasterProduct::create([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'product_name' => $request->product_name,
            'slug' => $slug,
            'image' => $imagePath, 
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(), 
        ]);

        return redirect()->route('master-products.index')->with('message', 'Product added successfully.');
    }

    
    public function edit($id)
    {
        $details = MasterProduct::findOrFail($id);
        $categories = Category::whereNull('deleted_by')->get();
        $subcategories = SubCategory::where('category_id', $details->category_id)->whereNull('deleted_by')->get();
    
        return view('backend.products.edit', compact('details', 'categories', 'subcategories'));
    }
    

    public function update(Request $request, $id)
    {
        $product = MasterProduct::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:master_category,id',
            'sub_category_id' => 'required|exists:master_sub_category,id',
            'product_name' => 'required|string|max:255|unique:master_products,product_name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'category_id.required' => 'Please select a product category.',
            'category_id.exists' => 'The selected category does not exist.',

            'sub_category_id.required' => 'Please select a product subcategory.',
            'sub_category_id.exists' => 'The selected subcategory does not exist.',

            'product_name.required' => 'The product name is required.',
            'product_name.string' => 'The product name must be a valid string.',
            'product_name.max' => 'The product name must not exceed 255 characters.',
            'product_name.unique' => 'This product name is already taken. Please choose another.',

            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        $slug = Str::slug($request->product_name, '-');

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

                $product->image = $new_name;
            }
        }

        $product->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'product_name' => $request->product_name,
            'slug' => $slug,
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('master-products.index')->with('message', 'Product updated successfully.');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = MasterProduct::findOrFail($id);
            $industries->update($data);

            return redirect()->route('master-products.index')->with('message', 'Product deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    

}