<?php

namespace App\Http\Controllers\Frontend;

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

class ProductDetailsController extends Controller
{

    public function details($slug)
    {
        $product = ProductDetail::select(
                'product_details.*', 
                'product_category.category_name as category_name', 
                'products.product_name as product_name'
            )
            ->join('products', 'product_details.product_id', '=', 'products.id')
            ->join('product_category', 'product_details.category_id', '=', 'product_category.id')
            ->where('products.slug', $slug)
            ->firstOrFail();
    
        return view('frontend.product-details', compact('product'));
    }
    
    
}