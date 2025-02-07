<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\PreWiringPartB;

use Carbon\Carbon;

class PreWiringPartBController extends Controller
{

    public function index()
    {
        $details = PreWiringPartB::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.services.consult.partB.index', compact('details'));
    }

    public function create(Request $request)
    { 
        return view('backend.services.consult.partB.create');
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detailed_description' => 'required|string',
            'section_heading' => 'required|string|max:255',
            'calculation_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'calculation_titles.*' => 'required|string|max:255',
            'calculation_descriptions.*' => 'required|string',
        ]);

        // Handle Product Image Upload
        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            $productImageName = time() . rand(10, 999) . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('uploads/services/'), $productImageName);
        }

        // Handle Calculation Data
        $calculationImages = [];
        $calculationTitles = $request->calculation_titles ?? [];
        $calculationDescriptions = $request->calculation_descriptions ?? [];

        if ($request->hasFile('calculation_images')) {
            foreach ($request->file('calculation_images') as $index => $calculationImage) {
                if ($calculationImage->isValid()) {
                    $calculationImageName = time() . rand(10, 999) . '.' . $calculationImage->getClientOriginalExtension();
                    $calculationImage->move(public_path('uploads/services/'), $calculationImageName);
                    $calculationImages[] = $calculationImageName;
                }
            }
        }

        $maxCount = max(count($calculationImages), count($calculationTitles), count($calculationDescriptions));

        $calculationImages = array_pad($calculationImages, $maxCount, null);
        $calculationTitles = array_pad($calculationTitles, $maxCount, '');
        $calculationDescriptions = array_pad($calculationDescriptions, $maxCount, '');

        PreWiringPartB::create([
            'image' => $productImageName ?? null,
            'detailed_description' => $request->detailed_description,
            'section_heading' => $request->section_heading,
            'calculation_images' => json_encode($calculationImages), 
            'calculation_titles' => json_encode($calculationTitles), 
            'calculation_descriptions' => json_encode($calculationDescriptions),
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);


        return redirect()->route('pre-wiring-partB.index')->with('message', 'Details added successfully.');
    }

    public function edit($id)
    {
        $details = PreWiringPartB::findOrFail($id);
        $calculation_images = json_decode($details->calculation_images, true);
        $calculation_titles = json_decode($details->calculation_titles, true);
        $calculation_descriptions = json_decode($details->calculation_descriptions, true);
    
        return view('backend.services.consult.partB.edit', compact('details', 'calculation_images', 'calculation_titles', 'calculation_descriptions'));
    }


    public function update(Request $request, $id)
    {
        // dd($request);
        $details = PreWiringPartB::findOrFail($id);

        $validatedData = $request->validate([
           
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'detailed_description' => 'required|string',
            'section_heading' => 'required|string|max:255',
            'calculation_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'calculation_titles.*' => 'required|string|max:255',
            'calculation_descriptions.*' => 'required|string',
        ]);

        // Handle Banner Image Upload
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/services/'), $bannerImageName);

        } else {
            $bannerImageName = $details->banner_image;
        }

        // Handle Product Image Upload
        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            $productImageName = time() . rand(10, 999) . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('uploads/services/'), $productImageName);

        } else {
            $productImageName = $details->image;
        }

        $calculationImages = json_decode($details->calculation_images, true) ?? [];
        $calculationTitles = json_decode($details->calculation_titles, true) ?? [];
        $calculationDescriptions = json_decode($details->calculation_descriptions, true) ?? [];

        $deletedImages = json_decode($request->deleted_calculation_images, true);
        $deletedImages = is_array($deletedImages) ? $deletedImages : [];

        foreach ($deletedImages as $deletedImage) {
            if (($key = array_search($deletedImage, $calculationImages)) !== false) {
                unset($calculationImages[$key]); 
                unset($calculationTitles[$key]); 
                unset($calculationDescriptions[$key]); 

            }
        }

        $calculationImages = array_values($calculationImages);
        $calculationTitles = array_values($calculationTitles);
        $calculationDescriptions = array_values($calculationDescriptions);

        $existingImages = $request->existing_images ?? [];
        $calculationImages = $existingImages;
        $calculationTitles = $request->calculation_titles ?? [];
        $calculationDescriptions = $request->calculation_descriptions ?? [];


        // **Handle New Image Uploads**
        if ($request->hasFile('calculation_images')) {
            foreach ($request->file('calculation_images') as $calculationImage) {
                if ($calculationImage->isValid()) {
                    $calculationImageName = time() . rand(10, 999) . '.' . $calculationImage->getClientOriginalExtension();
                    $calculationImage->move(public_path('uploads/services/'), $calculationImageName);
                    $calculationImages[] = $calculationImageName; 
                }
            }
        }

        // Ensure consistency in array sizes
        $maxCount = max(count($calculationImages), count($calculationTitles), count($calculationDescriptions));
        $calculationImages = array_slice(array_values($calculationImages), 0, $maxCount);
        $calculationTitles = array_slice(array_values($calculationTitles), 0, $maxCount);
        $calculationDescriptions = array_slice(array_values($calculationDescriptions), 0, $maxCount);

        $details->update([
          
            'image' => $productImageName,
            'detailed_description' => $request->detailed_description,
            'section_heading' => $request->section_heading,
            'calculation_images' => json_encode($calculationImages),
            'calculation_titles' => json_encode($calculationTitles),
            'calculation_descriptions' => json_encode($calculationDescriptions),
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('pre-wiring-partB.index')->with('message', 'Details updated successfully.');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = PreWiringPartB::findOrFail($id);
            $industries->update($data);

            return redirect()->route('pre-wiring-partB.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
}