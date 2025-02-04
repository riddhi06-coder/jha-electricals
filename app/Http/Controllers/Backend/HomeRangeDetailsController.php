<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeRange;

use Carbon\Carbon;

class HomeRangeDetailsController extends Controller
{

    public function index()
    {
        $range = HomeRange::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.range.index', compact('range'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.range.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|string',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'product_name.required' => 'The product name is required.',
            'product_price.required' => 'The product price is required.',
            'banner_image.required' => 'Please upload a product image.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',
        ]);

        $range = new HomeRange();
        $range->section_heading = $request->banner_heading;
        $range->product_name = $request->product_name;
        $range->product_price = $request->product_price;
        $range->inserted_at = Carbon::now();
        $range->inserted_by = Auth::id();

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;

                $destinationPath = public_path('/uploads/home/range');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $new_name);
                $range->image = $new_name;
            }
        }

        $range->save();

        return redirect()->route('home-range.index')->with('message', 'Product details created successfully!');
    }

    public function edit($id)
    {
        $range = HomeRange::findOrFail($id);
        return view('backend.home.range.edit', compact('range'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'product_name.required' => 'The product name is required.',
            'product_price.required' => 'The product price is required.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',
        ]);

        $range = HomeRange::findOrFail($id);
        $range->section_heading = $request->banner_heading;
        $range->product_name = $request->product_name;
        $range->product_price = $request->product_price;
        $range->modified_at = Carbon::now();
        $range->modified_by = Auth::id();

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;

                $destinationPath = public_path('/uploads/home/range');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $new_name);
                $range->image = $new_name;
            }
        }

        $range->save();

        return redirect()->route('home-range.index')->with('message', 'Details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeRange::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-range.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}