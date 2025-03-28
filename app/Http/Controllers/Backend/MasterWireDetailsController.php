<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Category;
use App\Models\MasterProduct;
use App\Models\ProductDetails;
use App\Models\SubCategory;
use App\Models\WireDetail;



class MasterWireDetailsController extends Controller
{

    public function index()
    {
        $wireDetails = DB::table('master_wire_details')
            ->join('master_category', 'master_wire_details.category_id', '=', 'master_category.id')
            ->join('master_sub_category', 'master_wire_details.sub_category_id', '=', 'master_sub_category.id')
            ->join('master_products', 'master_wire_details.product_id', '=', 'master_products.id')
            ->select(
                'master_wire_details.id',
                'master_category.category_name',
                'master_sub_category.sub_category_name',
                'master_products.product_name'
            )
            ->whereNull('master_wire_details.deleted_by')
            ->get();
    
        return view('backend.product-details.wires.index', compact('wireDetails'));
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
        $categories = Category::where('category_name', 'Wires') 
            ->whereNull('deleted_by')
            ->get();
    
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
    
        return view('backend.product-details.wires.create', compact('categories', 'groupedSubcategories', 'groupedProducts', 'products'));
    }


    public function store(Request $request)
    {
        // dd($request);
        // Validation Rules
        $validator = Validator::make($request->all(), [
            'category_id'       => 'required|exists:master_category,id',
            'sub_category_id'   => 'required|exists:master_sub_category,id',
            'product_id'      => 'required|exists:master_products,id',
            'product_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'detailed_description' => 'required|string',
            'background_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string',
            'approvals' => 'nullable|string|max:255',
            'voltage_grade' => 'nullable|string|max:255',
            'conductor' => 'nullable|string',
            'conductor_specialty' => 'nullable|string|max:255',
            'insulation' => 'nullable|string|max:255',
            'colours' => 'nullable|string|max:255',
            'marking' => 'nullable|string',
            'packing' => 'nullable|string|max:255',
            'brochures.*' => 'nullable|mimes:pdf|max:3072',
        ], [
            'category_id.required' => 'Please select a product category.',
            'category_id.exists' => 'Selected category is invalid.',
            'sub_category_id.required' => 'Please select a product sub-category.',
            'sub_category_id.exists' => 'Selected sub-category is invalid.',
            'product_id.required' => 'Please select a product.',
            'product_id.exists' => 'Selected product is invalid.',
            'product_image.required' => 'Please upload a product image.',
            'product_image.image' => 'The product image must be an image file.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP files are allowed.',
            'product_image.max' => 'The product image size must be less than 2MB.',
            'detailed_description.required' => 'Please enter a detailed description.',
            'background_image.required' => 'Please upload a background image.',
            'background_image.image' => 'The background image must be an image file.',
            'background_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP files are allowed.',
            'background_image.max' => 'The background image size must be less than 2MB.',
            'description.required' => 'Please enter a description.',
            'brochure.mimes' => 'Only PDF files are allowed for the brochure.',
            'brochure.max' => 'The brochure file size must be less than 3MB.',
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

          // Upload Product Image
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $productImageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/wire-details/'), $productImageName);
        }

        // Upload Background Image (if exists)
        $backgroundImageName = null;
        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $backgroundImageName = time() . '_bg.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/wire-details/'), $backgroundImageName);
        }

        $brochureName = null;

        // Upload Brochure PDF
        if ($request->hasFile('brochure')) {
            $brochure = $request->file('brochure');
            $brochureName = time() . '.' . $brochure->getClientOriginalExtension();
            $brochure->move(public_path('/uploads/wire-details/brochures/'), $brochureName);
        }

        WireDetail::create([
            'category_id'         => $request->category_id,
            'sub_category_id'     => $request->sub_category_id,
            'product_id'          => $request->product_id,
            'product_images'      => $productImageName,
            'detailed_description'=> $request->detailed_description,
            'background_images'   => $backgroundImageName,
            'description'         => $request->description,
            'approvals'           => $request->approvals,
            'voltage_grade'       => $request->voltage_grade,
            'conductor'           => $request->conductor,
            'conductor_specialty' => $request->conductor_specialty,
            'insulation'          => $request->insulation,
            'colours'             => $request->colours,
            'marking'             => $request->marking,
            'packing'             => $request->packing,
            'brochures'           => $brochureName,
            'inserted_at'         => Carbon::now(),
            'inserted_by'         => Auth::id(),
        ]);

        return redirect()->route('wire-details.index')->with('message', 'Wire details added successfully.');
    }


    public function edit($id)
    {
        $details = WireDetail::findOrFail($id);
        // Fetch all categories, subcategories, and products
        // $categories = Category::where('category_name', 'Wires') 
        //                         ->whereNull('deleted_by')
        //                         ->get();
        // $subcategories = SubCategory::whereNull('deleted_by')->get();
        // $products = MasterProduct::whereNull('deleted_by')->get();


        // Fetch categories (assuming 'Wires' is the main category)
        $categories = Category::where('category_name', 'Wires')
        ->whereNull('deleted_by')
        ->get();

        // Fetch only subcategories related to 'Wires' category
        $subcategories = SubCategory::where('category_id', 4) 
        ->whereNull('deleted_by')
        ->get();

        // Fetch products based on selected sub-category
        $products = MasterProduct::whereIn('sub_category_id', function ($query) {
        $query->select('id')
            ->from('master_sub_category')
            ->where('category_id', 4) 
            ->whereNull('deleted_by');
        })
        ->whereNull('deleted_by')
        ->get();
    
        // Group subcategories by category_id
        $groupedSubcategories = [];
        foreach ($subcategories as $subcategory) {
            $groupedSubcategories[$subcategory->category_id][] = [
                'id' => $subcategory->id,
                'name' => $subcategory->sub_category_name
            ];
        }
    
        // Group products by sub_category_id
        $groupedProducts = [];
        foreach ($products as $product) {
            $groupedProducts[$product->sub_category_id][] = [
                'id' => $product->id,
                'name' => $product->product_name
            ];
        }

        return view('backend.product-details.wires.edit', compact(
            'details', 
            'categories', 
            'groupedSubcategories', 
            'groupedProducts', 
            'products'
        ));
    }
    

    public function update(Request $request, $id)
    {
        $details = WireDetail::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'category_id'       => 'required|exists:master_category,id',
            'sub_category_id'   => 'required|exists:master_sub_category,id',
            'product_id'        => 'required|exists:master_products,id',
            'product_image'     => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'detailed_description' => 'required|string',
            'background_image'  => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'description'       => 'required|string',
            'approvals'         => 'nullable|string|max:255',
            'voltage_grade'     => 'nullable|string|max:255',
            'conductor'         => 'nullable|string',
            'conductor_specialty' => 'nullable|string|max:255',
            'insulation'        => 'nullable|string|max:255',
            'colours'           => 'nullable|string|max:255',
            'marking'           => 'nullable|string',
            'packing'           => 'nullable|string|max:255',
            'brochure'          => 'nullable|mimes:pdf|max:3072',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update Product Image (if new image is uploaded)
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $productImageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/wire-details/'), $productImageName);
            // Delete old image
            if ($details->product_images) {
            }
        } else {
            $productImageName = $details->product_images; // Retain old image
        }

        // Update Background Image (if new image is uploaded)
        if ($request->hasFile('background_image')) {
            $image = $request->file('background_image');
            $backgroundImageName = time() . '_bg.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads/wire-details/'), $backgroundImageName);
            // Delete old background image
            if ($details->background_images) {
            }
        } else {
            $backgroundImageName = $details->background_images; // Retain old background image
        }

        $brochureName = $details->brochures ?? null;

        // Update Brochure (if a new brochure is uploaded)
        if ($request->hasFile('brochure')) {
            $brochure = $request->file('brochure');
            $brochureName = time() . '.' . $brochure->getClientOriginalExtension();
            $brochure->move(public_path('/uploads/wire-details/brochures/'), $brochureName);
            
            // Delete old brochure if it exists
            if (!empty($details->brochures)) {
                $oldBrochurePath = public_path('/uploads/wire-details/brochures/') . $details->brochures;
            }  else {
                $brochureName = $details->brochures; 
            }
    
        }
        
    
        // Update record
        $details->update([
            'category_id'         => $request->category_id,
            'sub_category_id'     => $request->sub_category_id,
            'product_id'          => $request->product_id,
            'product_images'      => $productImageName,
            'detailed_description'=> $request->detailed_description,
            'background_images'   => $backgroundImageName,
            'description'         => $request->description,
            'approvals'           => $request->approvals,
            'voltage_grade'       => $request->voltage_grade,
            'conductor'           => $request->conductor,
            'conductor_specialty' => $request->conductor_specialty,
            'insulation'          => $request->insulation,
            'colours'             => $request->colours,
            'marking'             => $request->marking,
            'packing'             => $request->packing,
            'brochures'           => $brochureName,
            'modified_at'         => Carbon::now(),
            'modified_by'         => Auth::id(),
        ]);

        return redirect()->route('wire-details.index')->with('message', 'Wire details updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = WireDetail::findOrFail($id);
            $industries->update($data);

            return redirect()->route('wire-details.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}