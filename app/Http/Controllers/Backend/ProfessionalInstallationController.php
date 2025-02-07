<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ProfessionalInstall;


use Carbon\Carbon;

class ProfessionalInstallationController extends Controller
{

    public function index()
    {
        $details = ProfessionalInstall::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.services.install.index', compact('details'));
    }

    public function create(Request $request)
    { 
        return view('backend.services.install.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'product_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detailed_description' => 'required|string',
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',

            'product_image.required' => 'Please upload an image.',
            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'product_image.max' => 'The image must be less than 2MB.',

            'detailed_description.required' => 'The detailed description is required.',
            'detailed_description.string' => 'The description must be a valid string.',
        ]);

        // Handle Banner Image upload
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            if ($bannerImage->isValid()) {
                $bannerImageExtension = $bannerImage->getClientOriginalExtension();
                $bannerImageName = time() . rand(10, 999) . '.' . $bannerImageExtension;
                $bannerImagePath = public_path('uploads/services/');

                if (!file_exists($bannerImagePath)) {
                    mkdir($bannerImagePath, 0777, true);
                }

                $bannerImage->move($bannerImagePath, $bannerImageName);
                $bannerImagePath = $bannerImageName;
            }
        }

        // Handle Product Image Upload
        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            if ($productImage->isValid()) {
                $productImageExtension = $productImage->getClientOriginalExtension();
                $productImageName = time() . rand(10, 999) . '.' . $productImageExtension;
                $productImagePath = public_path('uploads/services/');

                if (!file_exists($productImagePath)) {
                    mkdir($productImagePath, 0777, true);
                }

                $productImage->move($productImagePath, $productImageName);
            }
        }

        ProfessionalInstall::create([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $bannerImageName ?? null,
            'image' => $productImageName ?? null,
            'detailed_description' => $request->detailed_description,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);

        return redirect()->route('professional-install.index')->with('message', 'Details added successfully.');
    }

    public function edit($id)
    {
        $details = ProfessionalInstall::findOrFail($id);
        return view('backend.services.install.edit', compact('details'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detailed_description' => 'required|string',
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',

            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'product_image.max' => 'The image must be less than 2MB.',

            'detailed_description.required' => 'The detailed description is required.',
            'detailed_description.string' => 'The description must be a valid string.',
        ]);

        $details = ProfessionalInstall::findOrFail($id);

        // Handle Banner Image upload
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            if ($bannerImage->isValid()) {
                $bannerImageExtension = $bannerImage->getClientOriginalExtension();
                $bannerImageName = time() . rand(10, 999) . '.' . $bannerImageExtension;
                $bannerImagePath = public_path('uploads/services/');

                if (!file_exists($bannerImagePath)) {
                    mkdir($bannerImagePath, 0777, true);
                }

                $bannerImage->move($bannerImagePath, $bannerImageName);
                $details->banner_image = $bannerImageName;
            }
        }

        // Handle Product Image Upload
        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            if ($productImage->isValid()) {
                $productImageExtension = $productImage->getClientOriginalExtension();
                $productImageName = time() . rand(10, 999) . '.' . $productImageExtension;
                $productImagePath = public_path('uploads/services/');

                if (!file_exists($productImagePath)) {
                    mkdir($productImagePath, 0777, true);
                }

                $productImage->move($productImagePath, $productImageName);
                $details->image = $productImageName;
            }
        }

        // Update fields
        $details->banner_heading = $request->banner_heading;
        $details->detailed_description = $request->detailed_description;
        $details->modified_at = Carbon::now();
        $details->modified_by = Auth::id();
        $details->save();

        return redirect()->route('professional-install.index')->with('message', 'Details updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = ProfessionalInstall::findOrFail($id);
            $industries->update($data);

            return redirect()->route('professional-install.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }




}