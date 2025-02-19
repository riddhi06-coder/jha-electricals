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
use App\Models\ProductDetail;
use Carbon\Carbon;


class ProductDetailController extends Controller
{

    public function index()
    {
        $products = ProductDetail::with('product')->get(); 
        return view('backend.product.product-details.index', compact('products'));
    }
    

    public function create()
    { 
        $categories = ProductCategory::whereNull('deleted_by')->get();
        $products = Product::whereNull('deleted_by')->get();
    
        $groupedProducts = [];
        foreach ($products as $product) {
            $groupedProducts[$product->category_id][] = [
                'id' => $product->id,
                'name' => $product->product_name
            ];
        }
    
        return view('backend.product.product-details.create', compact('categories', 'groupedProducts'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|exists:product_category,id',
            'product_name'      => 'required|exists:products,id',
            'section_heading'   => 'required|string|max:255',
            'product_images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_codes.*'   => 'required|string',
            'product_wattages.*'=> 'required|string',
            'product_sizes.*'   => 'required|string',
            'product_mrps.*'    => 'required|string',
        ], [
            'category_id.required'       => 'Please select a product category.',
            'category_id.exists'         => 'The selected product category is invalid.',
            'product_name.required'      => 'Please select a product.',
            'product_name.exists'        => 'The selected product is invalid.',
            'section_heading.required'   => 'Please enter a section heading.',
            'section_heading.max'        => 'The section heading must not exceed 255 characters.',
            'product_images.*.image'     => 'Each file must be an image.',
            'product_images.*.mimes'     => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'product_images.*.max'       => 'Each image should not exceed 2MB in size.',
            'product_codes.*.required'   => 'Please enter a product code.',
            'product_wattages.*.required'=> 'Please enter the wattage.',
            'product_sizes.*.required'   => 'Please enter the outer size.',
            'product_mrps.*.required'    => 'Please enter the MRP.',
        ]);

        // Handle Image Uploads
        $imagePaths = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;

                    $destinationPath = public_path('/uploads/products/');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }

                    $image->move($destinationPath, $new_name);
                    $imagePaths[] = $new_name; 
                }
            }
        }

        $productImagesJson   = json_encode($imagePaths);
        $productCodesJson    = json_encode($request->product_codes);
        $productWattagesJson = json_encode($request->product_wattages);
        $productSizesJson    = json_encode($request->product_sizes);
        $productMrpsJson     = json_encode($request->product_mrps);

        ProductDetail::create([
            'category_id'       => $request->category_id,
            'product_id'      => $request->product_name,
            'section_heading'   => $request->section_heading,
            'product_images'    => $productImagesJson,
            'product_codes'     => $productCodesJson,
            'product_wattages'  => $productWattagesJson,
            'product_sizes'     => $productSizesJson,
            'product_mrps'      => $productMrpsJson,
            'inserted_at'       => Carbon::now(),
            'inserted_by'       => Auth::id(), 
        ]);

        return redirect()->route('product-detail.index')->with('message', 'Product details saved successfully!');
    }


    public function edit($id)
    {
        $categories = ProductCategory::whereNull('deleted_by')->get();
        $products = Product::whereNull('deleted_by')->get();

        $groupedProducts = [];
        foreach ($products as $product) {
            $groupedProducts[$product->category_id][] = [
                'id' => $product->id,
                'name' => $product->product_name
            ];
        }

        $details = ProductDetail::findOrFail($id);

        $details->product_images = json_decode($details->product_images, true);
        $details->product_codes = json_decode($details->product_codes, true);
        $details->product_wattages = json_decode($details->product_wattages, true);
        $details->product_sizes = json_decode($details->product_sizes, true);
        $details->product_mrps = json_decode($details->product_mrps, true);

        return view('backend.product.product-details.edit', compact('details', 'categories', 'groupedProducts', 'products'));
    }


    
}