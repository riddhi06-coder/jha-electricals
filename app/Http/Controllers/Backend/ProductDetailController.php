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


class ProductDetailController extends Controller
{

    public function index()
    {
        return view('backend.product.product-details.index');
    }


    public function create()
    { 
        $categories = ProductCategory::whereNull('deleted_by')->get();
        $products = Product::whereNull('deleted_by')->get(); 
    
        return view('backend.product.product-details.create', compact('categories', 'products'));
    }
    
}