<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use App\Models\Product;
use Carbon\Carbon;


class ProductsController extends Controller
{

    public function index()
    {
        $products = Product::select('products.*', 'product_category.category_name')
            ->leftJoin('product_category', 'product_category.id', '=', 'products.category_id')
            ->orderBy('products.id', 'desc')
            ->whereNull('products.deleted_by')
            ->get();

        return view('backend.product.add-product.index', compact('products'));
    }


    public function create()
    { 
        $categories = ProductCategory::whereNull('deleted_by')->get();
        return view('backend.product.add-product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:product_category,id',
            'product_name' => 'required|string|max:255|unique:products,product_name',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'category_id.required' => 'Please select a product category.',
            'category_id.exists' => 'The selected category does not exist.',

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

        Product::create([
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'slug' => $slug,
            'image' => $imagePath, 
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(), 
        ]);

        return redirect()->route('add-products.index')->with('message', 'Product added successfully.');
    }

    
    public function edit($id)
    {
        $details = Product::findOrFail($id);
        $categories = ProductCategory::get(); 
        return view('backend.product.add-product.edit', compact('details', 'categories'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:product_category,id',
            'product_name' => 'required|string|max:255|unique:products,product_name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'category_id.required' => 'Please select a product category.',
            'category_id.exists' => 'The selected category does not exist.',

            'product_name.required' => 'The product name is required.',
            'product_name.string' => 'The product name must be a valid string.',
            'product_name.max' => 'The product name must not exceed 255 characters.',
            'product_name.unique' => 'This product name is already taken. Please choose another.',

            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        $product = Product::findOrFail($id);

        $slug = Str::slug($request->product_name, '-');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $new_name = time() . rand(10, 999) . '.' . $extension;

            $destinationPath = public_path('/uploads/products/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $image->move($destinationPath, $new_name);

            $product->image = $new_name;
        }

        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->slug = $slug;
        $product->modified_at = Carbon::now();
        $product->modified_by = Auth::id(); 
        $product->save();

        return redirect()->route('add-products.index')->with('message', 'Product updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Product::findOrFail($id);
            $industries->update($data);

            return redirect()->route('add-products.index')->with('message', 'Product deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}