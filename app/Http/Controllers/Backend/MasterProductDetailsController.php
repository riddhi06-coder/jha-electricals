<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\MasterProduct;
use App\Models\ProductDetails;
use App\Models\SubCategory;
use Carbon\Carbon;


class MasterProductDetailsController extends Controller
{

    public function index()
    {
        $products = ProductDetails::with('product.category', 'product.subcategory') 
                                ->whereNull('deleted_by')
                                ->get(); 

        return view('backend.product-details.products.index', compact('products'));
    }
    

    public function getSubcategories(Request $request)
    {
        $subcategories = SubCategory::where('category_id', $request->category_id)
                                    ->whereNull('deleted_by')
                                    ->get(['id', 'sub_category_name as name']);

        return response()->json(['subcategories' => $subcategories]);
    }

    public function getProducts(Request $request)
    {
        $products = MasterProduct::where('sub_category_id', $request->sub_category_id)
                                ->whereNull('deleted_by')
                                ->get(['id', 'product_name as name']);

        return response()->json(['products' => $products]);
    }


    
    public function create()
    { 
        $categories = Category::whereNull('deleted_by')->get();
        $subcategories = SubCategory::whereNull('deleted_by')->get();
        $products = MasterProduct::whereNull('deleted_by')->get();
    
        $groupedSubcategories = [];
        $groupedProducts = [];
    
        // Group subcategories by category_id
        foreach ($subcategories as $subcategory) {
            $groupedSubcategories[$subcategory->category_id][] = [
                'id' => $subcategory->id,
                'name' => $subcategory->sub_category_name
            ];
        }
    
        // Group products by sub_category_id
        foreach ($products as $product) {
            $groupedProducts[$product->sub_category_id][] = [
                'id' => $product->id,
                'name' => $product->product_name
            ];
        }
    
        return view('backend.product-details.products.create', compact('categories', 'groupedSubcategories', 'groupedProducts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|exists:master_category,id',
            'sub_category_id'   => 'required|exists:master_sub_category,id',
            'product_id'      => 'required|exists:master_products,id',
            'section_heading'   => 'required|string|max:255',
            'product_images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_codes.*'   => 'required|string',
            'product_wattages.*'=> 'required|string',
            'product_sizes.*'   => 'required|string',
            'product_mrps.*'    => 'required|string',
        ], [
            'category_id.required'       => 'Please select a product category.',
            'category_id.exists'         => 'The selected product category is invalid.',
            'sub_category_id.required'   => 'Please select a product sub category.',
            'sub_category_id.exists'     => 'The selected product sub category is invalid.',
            'product_id.required'      => 'Please select a product.',
            'product_id.exists'        => 'The selected product is invalid.',
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

        ProductDetails::create([
            'category_id'       => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'product_id'        => $request->product_id,
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
        $categories = Category::whereNull('deleted_by')->get();
        $subcategories = SubCategory::whereNull('deleted_by')->get();
        $products = MasterProduct::whereNull('deleted_by')->get();
    
        $groupedSubcategories = [];
        $groupedProducts = [];
    
        // Group subcategories by category_id
        foreach ($subcategories as $subcategory) {
            $groupedSubcategories[$subcategory->category_id][] = [
                'id' => $subcategory->id,
                'name' => $subcategory->sub_category_name
            ];
        }
    
        // Group products by sub_category_id
        foreach ($products as $product) {
            $groupedProducts[$product->sub_category_id][] = [
                'id' => $product->id,
                'name' => $product->product_name
            ];
        }
    
        // Fetch product details
        $details = ProductDetails::findOrFail($id);
    
        $details->product_images = json_decode($details->product_images, true);
        $details->product_codes = json_decode($details->product_codes, true);
        $details->product_wattages = json_decode($details->product_wattages, true);
        $details->product_sizes = json_decode($details->product_sizes, true);
        $details->product_mrps = json_decode($details->product_mrps, true);
    
        return view('backend.product-details.products.edit', compact('details', 'categories', 'groupedSubcategories', 'groupedProducts', 'products'));
    }
    

    
}