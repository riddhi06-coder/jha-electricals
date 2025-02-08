<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ResideLightPartC;

use Carbon\Carbon;

class ResideLightPartCController extends Controller
{

    public function index()
    {
        $details = ResideLightPartC::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.application.residential.partC.index', compact('details'));
    }

    public function create(Request $request)
    { 
        return view('backend.application.residential.partC.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'required|string|max:255',
            'detailed_description' => 'required|string',
        ], [
            'banner_heading.required' => 'The Section Heading field is required.',
            'banner_heading.max' => 'The Section Heading cannot exceed 255 characters.',
        
            'short_description.required' => 'The Short Description field is required.',
        
            'product_image.required' => 'Please upload an image.',
            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'product_image.max' => 'The image size must not exceed 2MB.',
        
            'title.required' => 'The Title field is required.',
            'title.max' => 'The Title cannot exceed 255 characters.',
        
            'detailed_description.required' => 'The Detailed Description field is required.',
        ]);

        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            $productImageName = time() . rand(10, 999) . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('uploads/application/'), $productImageName);
        }

        ResideLightPartC::create([
            'section_heading' => $request->banner_heading,
            'short_description' => $request->short_description,
            'image' => $productImageName ?? null,
            'title' => $request->title,
            'detailed_description' => $request->detailed_description,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);

        return redirect()->route('reside-light-partC.index')->with('message', 'Details added successfully.');
    }

    public function edit($id)
    {
        $details = ResideLightPartC::findOrFail($id);
      
        return view('backend.application.residential.partC.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'required|string|max:255',
            'detailed_description' => 'required|string',
        ], [
            'banner_heading.max' => 'The Section Heading cannot exceed 255 characters.',

            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'product_image.max' => 'The image size must not exceed 2MB.',

            'title.required' => 'The Title field is required.',
            'title.max' => 'The Title cannot exceed 255 characters.',

            'detailed_description.required' => 'The Detailed Description field is required.',
        ]);

        $details = ResideLightPartC::findOrFail($id);

        if ($request->hasFile('product_image')) {
            
            $productImage = $request->file('product_image');
            $productImageName = time() . rand(10, 999) . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('uploads/application/'), $productImageName);
        } else {
            $productImageName = $details->image; 
        }

        $details->update([
            'section_heading' => $request->banner_heading,
            'short_description' => $request->short_description,
            'image' => $productImageName,
            'title' => $request->title,
            'detailed_description' => $request->detailed_description,
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('reside-light-partC.index')->with('message', 'Details updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ResideLightPartC::findOrFail($id);
            $industries->update($data);

            return redirect()->route('reside-light-partC.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}