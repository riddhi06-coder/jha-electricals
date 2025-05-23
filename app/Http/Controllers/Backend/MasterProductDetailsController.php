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
            'product_codes.*'   => 'nullable|string',
            'product_wattages.*'=> 'nullable|string',
            'product_sizes.*'   => 'nullable|string',
            'product_mrps.*'    => 'nullable|string',

            'product_header' => 'required|array|min:1',
            'product_header.*' => 'required|string|max:255',

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
            
            'product_header.required' => 'Please add at least one product header.',
            'product_header.array' => 'Product headers must be an array.',
            'product_header.min' => 'Please add at least one product header.',
            'product_header.*.required' => 'Each product header field is required.',
            'product_header.*.string' => 'Each product header must be a valid string.',
            'product_header.*.max' => 'Each product header must not exceed 255 characters.',
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
        $productheaders     = json_encode($request->product_header);

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
            'product_header'      => $productheaders,
            'inserted_at'       => Carbon::now(),
            'inserted_by'       => Auth::id(), 
        ]);

        return redirect()->route('master-product-details.index')->with('message', 'Product details saved successfully!');
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
        $details->product_header = json_decode($details->product_header, true);
    
        return view('backend.product-details.products.edit', compact('details', 'categories', 'groupedSubcategories', 'groupedProducts', 'products'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id'       => 'required|exists:master_category,id',
            'sub_category_id'   => 'required|exists:master_sub_category,id',
            'product_id'      => 'required|exists:master_products,id',
            'section_heading'   => 'required|string|max:255',
            'product_images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'existing_images.*' => 'string',

            'product_codes.*'   => 'nullable|string',
            'product_wattages.*'=> 'nullable|string',
            'product_sizes.*'   => 'nullable|string',
            'product_mrps.*'    => 'nullable|string',
            
            'product_header' => 'required|array|min:1',
            'product_header.*' => 'required|string|max:255',
        ]);

        $productDetail = ProductDetails::findOrFail($id);

        $imagePaths = $request->existing_images ?? [];

        if ($request->removed_images) {
            $removedImages = json_decode($request->removed_images, true);
            
            foreach ($removedImages as $image) {
                $imagePath = public_path('/uploads/products/') . $image;
            }

            $imagePaths = array_values(array_diff($imagePaths, $removedImages));
        }

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

        $productDetail->update([
            'category_id'      => $request->category_id,
            'sub_category_id'   => $request->sub_category_id,
            'product_id'        => $request->product_id,
            'section_heading'  => $request->section_heading,
            'product_images'   => json_encode($imagePaths), 
            'product_codes'    => json_encode($request->product_codes),
            'product_wattages' => json_encode($request->product_wattages),
            'product_sizes'    => json_encode($request->product_sizes),
            'product_mrps'     => json_encode($request->product_mrps),
            'product_header'     => json_encode($request->product_header),
            'modified_at'      => Carbon::now(),
            'modified_by'      => Auth::id(),
        ]);

        return redirect()->route('master-product-details.index')->with('message', 'Product details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProductDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('master-product-details.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
    
}