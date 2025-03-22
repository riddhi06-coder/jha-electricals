<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;

use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\WireDetail;

use Carbon\Carbon;

class ProductDetailsController extends Controller
{


    public function details($slug)
    {
       
        // Fetch the category_id directly from master_products table
        $categoryId = DB::table('master_products')
            ->where('slug', $slug)
            ->value('category_id');

        if (!$categoryId) {
            abort(404, "Product not found");
        }


        // If category_id is 4, call the special function directly
        if ($categoryId == 4) {
            return $this->specialCategoryView($slug);
        }

        // Fetch product details normally for other categories
        $product = ProductDetails::select(
                'master_product_details.*', 
                'master_category.category_name as category_name', 
                'master_products.product_name as product_name',
                'master_sub_category.sub_category_name as sub_category_name'
            )
            ->join('master_products', 'master_product_details.product_id', '=', 'master_products.id')
            ->join('master_category', 'master_product_details.category_id', '=', 'master_category.id')
            ->leftJoin('master_sub_category', 'master_product_details.sub_category_id', '=', 'master_sub_category.id') 
            ->where('master_products.slug', $slug)
            ->first();

        if (!$product) {
            abort(404, "Product details not found");
        }

        return view('frontend.product-details', compact('product'));
    }

    // Function to handle category_id = 4
    private function specialCategoryView($slug)
    {
        // Fetch WireDetail directly based on the product slug
        $specialDetails = WireDetail::select(
                        'master_wire_details.*',
                        'master_category.category_name as category_name',
                        'master_sub_category.sub_category_name as sub_category_name',
                        'master_products.product_name as product_name'
                    )
                    ->join('master_products', 'master_wire_details.product_id', '=', 'master_products.id')
                    ->join('master_category', 'master_wire_details.category_id', '=', 'master_category.id')
                    ->leftJoin('master_sub_category', 'master_wire_details.sub_category_id', '=', 'master_sub_category.id')
                    ->where('master_products.slug', $slug)
                    ->first();

        if (!$specialDetails) {
            abort(404, "Wire details not found for this product.");
        }
        // dd($specialDetails);

        return view('frontend.wires-product-details', compact('specialDetails'));
    }



    public function submitEnquiry(Request $request)
    {
        $validatedData = $request->validate([
            'name'      => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'phone'     => 'required|digits_between:10,12',
            'email'     => 'required|email',
            'product'   => 'required|string',
            'quantity'  => 'required|integer|min:1',
            'location'  => 'required|string',
            'message'   => 'nullable|string',
        ]);

        // Email data
        $emailData = [
            'name'     => $validatedData['name'],
            'phone'    => $validatedData['phone'],
            'email'    => $validatedData['email'],
            'product'  => $validatedData['product'],
            'quantity' => $validatedData['quantity'],
            'location' => $validatedData['location'],
            'message'  => $validatedData['message'] ?? 'N/A',
        ];

        Mail::send('frontend.enquiry-email', ['emailData' => $emailData], function ($message) use ($validatedData) {
            $message->to('riddhi@matrixbricks.com')
                    ->cc('shweta@matrixbricks.com')
                    ->subject('New Product Enquiry')
                    ->replyTo($validatedData['email']);
        });
        

        return redirect()->route('thank.you');
    }
    
    
}