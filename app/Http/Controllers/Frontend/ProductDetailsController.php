<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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