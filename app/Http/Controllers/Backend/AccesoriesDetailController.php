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
use App\Models\Accessories;
use App\Models\AccessoriesDetail;
use Carbon\Carbon;


class AccesoriesDetailController extends Controller
{

    public function index()
    {
        $products = AccessoriesDetail::with('product') 
                ->whereNull('deleted_by')
                ->get(); 
        return view('backend.product.accessories.product-details.index', compact('products'));
    }
    
    
    public function create()
    { 
        $categories = AccessoriesCategory::whereNull('deleted_by')->get();
        $products = Accessories::whereNull('deleted_by')->get();
    
        $groupedProducts = [];
        foreach ($products as $product) {
            $groupedProducts[$product->category_id][] = [
                'id' => $product->id,
                'name' => $product->product_name
            ];
        }
    
        return view('backend.product.accessories.product-details.create', compact('categories', 'groupedProducts'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|exists:accessories_category,id',
            'product_name'      => 'required|exists:accessories,id',
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
            'product_wattages.*.required'=> 'Please enter the description.',
            'product_sizes.*.required'   => 'Please enter the Pkg.',
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

        AccessoriesDetail::create([
            'category_id'       => $request->category_id,
            'product_id'      => $request->product_name,
            'section_heading'   => $request->section_heading,
            'product_images'    => $productImagesJson,
            'product_codes'     => $productCodesJson,
            'product_description'  => $productWattagesJson,
            'product_mrps'     => $productSizesJson,
            'product_pkg'      => $productMrpsJson,
            'inserted_at'       => Carbon::now(),
            'inserted_by'       => Auth::id(), 
        ]);

        return redirect()->route('accessories-product-detail.index')->with('message', 'Accessories details saved successfully!');
    }


    public function edit($id)
    {
        $categories = AccessoriesCategory::whereNull('deleted_by')->get();
        $products = Accessories::whereNull('deleted_by')->get();

        $groupedProducts = [];
        foreach ($products as $product) {
            $groupedProducts[$product->category_id][] = [
                'id' => $product->id,
                'name' => $product->product_name
            ];
        }

        $details = AccessoriesDetail::findOrFail($id);

        $details->product_images = json_decode($details->product_images, true) ?? [];
        $details->product_codes = json_decode($details->product_codes, true) ?? [];
        $details->product_description = json_decode($details->product_description, true) ?? [];
        $details->product_pkg = json_decode($details->product_pkg, true) ?? [];
        $details->product_mrps = json_decode($details->product_mrps, true) ?? [];

        // dd($details->product_codes);
        return view('backend.product.accessories.product-details.edit', compact('details', 'categories', 'groupedProducts', 'products'));
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'category_id'       => 'required|exists:accessories_category,id',
            'product_name'      => 'required|exists:accessories,id',
            'section_heading'   => 'required|string|max:255',
            'product_images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'existing_images.*' => 'string',
            'product_codes.*'   => 'required|string',
            'product_wattages.*'=> 'required|string',
            'product_sizes.*'   => 'required|string',
            'product_mrps.*'    => 'required|string',
        ]);

        $productDetail = AccessoriesDetail::findOrFail($id);

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
            'product_id'       => $request->product_name,
            'section_heading'  => $request->section_heading,
            'product_images'   => json_encode($imagePaths), 
            'product_codes'    => json_encode($request->product_codes),
            'product_description' => json_encode($request->product_wattages),
            'product_pkg'    => json_encode($request->product_sizes),
            'product_mrps'     => json_encode($request->product_mrps),
            'modified_at'      => Carbon::now(),
            'modified_by'      => Auth::id(),
        ]);

        return redirect()->route('accessories-product-detail.index')->with('message', 'Accessories details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = AccessoriesDetail::findOrFail($id);
            $industries->update($data);

            return redirect()->route('accessories-product-detail.index')->with('message', 'Accessories deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}