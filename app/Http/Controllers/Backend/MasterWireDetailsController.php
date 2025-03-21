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
            'approvals' => 'required|string|max:255',
            'voltage_grade' => 'required|string|max:255',
            'conductor' => 'required|string',
            'conductor_specialty' => 'required|string|max:255',
            'insulation' => 'required|string|max:255',
            'colours' => 'required|string|max:255',
            'marking' => 'required|string',
            'packing' => 'required|string|max:255',
            'brochures.*' => 'mimes:pdf|max:3072',
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
            'approvals.required' => 'Please enter approvals.',
            'voltage_grade.required' => 'Please enter voltage grade.',
            'conductor.required' => 'Please enter conductor details.',
            'conductor_specialty.required' => 'Please enter conductor specialty.',
            'insulation.required' => 'Please enter insulation type.',
            'colours.required' => 'Please enter available colours.',
            'marking.required' => 'Please enter marking details.',
            'packing.required' => 'Please enter packing details.',
            'brochure.required' => 'Please upload a brochure.',
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
    
}