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


class MasterWireDetailsController extends Controller
{

    public function index()
    {
        $products = ProductDetails::with('product.category', 'product.subcategory') 
                                ->whereNull('deleted_by')
                                ->get(); 

        return view('backend.product-details.wires.index', compact('products'));
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
    
}