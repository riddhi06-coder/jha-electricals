<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SocialMedia;
use App\Models\WhoWeAre;

use Carbon\Carbon;

class WhoUsController extends Controller
{

    public function index()
    {
        $banners = WhoWeAre::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.about.why-choose.index', compact('banners'));
    }

    public function create(Request $request)
    { 
        return view('backend.about.why-choose.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'required|string',
            'description' => 'required|string',
        ], [
            'banner_title.required' => 'The banner title is required.',
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',

            'image.required' => 'Please upload an image.',
            'image.image' => 'The uploaded image must be an image.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'image.max' => 'The image must be less than 2MB.',

            'icon.required' => 'Please upload an icon.',
            'icon.image' => 'The uploaded icon must be an image.',
            'icon.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'icon.max' => 'The icon must be less than 2MB.',

            'short_description.required' => 'The short description is required.',
            'short_description.string' => 'The short description must be a valid string.',
            
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a valid string.',
        ]);

        // Handle Banner Image upload
        if ($request->hasFile('banner_image')) {
            $bannerImage = $request->file('banner_image');
            if ($bannerImage->isValid()) {
                $bannerImageExtension = $bannerImage->getClientOriginalExtension();
                $bannerImageName = time() . rand(10, 999) . '.' . $bannerImageExtension;
                $bannerImagePath = public_path('uploads/about/');

                if (!file_exists($bannerImagePath)) {
                    mkdir($bannerImagePath, 0777, true);
                }

                $bannerImage->move($bannerImagePath, $bannerImageName);
                $bannerImagePath = $bannerImageName;
            }
        }

        // Handle other file uploads
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if ($image->isValid()) {
                $imageExtension = $image->getClientOriginalExtension();
                $imageName = time() . rand(10, 999) . '.' . $imageExtension;
                $imagePath = public_path('uploads/about/');

                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }

                $image->move($imagePath, $imageName);
                $imagePath = $imageName;
            }
        }

        if ($request->hasFile('icon')) {
            $icon = $request->file('icon');
            if ($icon->isValid()) {
                $iconExtension = $icon->getClientOriginalExtension();
                $iconName = time() . rand(10, 999) . '.' . $iconExtension;
                $iconPath = public_path('uploads/about/');

                if (!file_exists($iconPath)) {
                    mkdir($iconPath, 0777, true);
                }

                $icon->move($iconPath, $iconName);
                $iconPath = $iconName;
            }
        }

        $whoWeAre = new WhoWeAre();
        $whoWeAre->banner_title = $request->banner_title;
        $whoWeAre->banner_image = $bannerImagePath ?? null;
        $whoWeAre->image = $imagePath ?? null;
        $whoWeAre->icon = $iconPath ?? null;
        $whoWeAre->short_description = $request->short_description;
        $whoWeAre->description = $request->description;
        $whoWeAre->inserted_at = Carbon::now();
        $whoWeAre->inserted_by = Auth::id();
        $whoWeAre->save();

        return redirect()->route('who-we-are.index')->with('message', 'Data saved successfully.');
    }

    public function edit($id)
    {
        $details = WhoWeAre::findOrFail($id);
        return view('backend.about.why-choose.edit', compact('details'));
    }


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'icon' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'short_description' => 'required|string',
            'description' => 'required|string',
        ], [
            'banner_title.required' => 'The banner title is required.',
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',

            'image.required' => 'Please upload an image.',
            'image.image' => 'The uploaded image must be an image.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'image.max' => 'The image must be less than 2MB.',

            'icon.required' => 'Please upload an icon.',
            'icon.image' => 'The uploaded icon must be an image.',
            'icon.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'icon.max' => 'The icon must be less than 2MB.',

            'short_description.required' => 'The short description is required.',
            'short_description.string' => 'The short description must be a valid string.',
            
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a valid string.',
        ]);

        $whoWeAre = WhoWeAre::findOrFail($id);

        if ($request->hasFile('banner_image')) {
          
            $bannerImage = $request->file('banner_image');
            $bannerImageExtension = $bannerImage->getClientOriginalExtension();
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImageExtension;
            $bannerImagePath = public_path('uploads/about/');

            if (!file_exists($bannerImagePath)) {
                mkdir($bannerImagePath, 0777, true);
            }

            $bannerImage->move($bannerImagePath, $bannerImageName);
            $whoWeAre->banner_image = $bannerImageName;
        }

        // Handle Image upload (if new image uploaded)
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageExtension = $image->getClientOriginalExtension();
            $imageName = time() . rand(10, 999) . '.' . $imageExtension;
            $imagePath = public_path('uploads/about/');

            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }

            $image->move($imagePath, $imageName);
            $whoWeAre->image = $imageName;
        }

        // Handle Icon upload (if new icon uploaded)
        if ($request->hasFile('icon')) {

            $icon = $request->file('icon');
            $iconExtension = $icon->getClientOriginalExtension();
            $iconName = time() . rand(10, 999) . '.' . $iconExtension;
            $iconPath = public_path('uploads/about/');

            if (!file_exists($iconPath)) {
                mkdir($iconPath, 0777, true);
            }

            $icon->move($iconPath, $iconName);
            $whoWeAre->icon = $iconName;
        }

        $whoWeAre->banner_title = $request->banner_title;
        $whoWeAre->short_description = $request->short_description;
        $whoWeAre->description = $request->description;
        $whoWeAre->modified_at = Carbon::now();
        $whoWeAre->modified_by = Auth::id();
        $whoWeAre->save();

        return redirect()->route('who-we-are.index')->with('message', 'Data updated successfully.');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = WhoWeAre::findOrFail($id);
            $industries->update($data);

            return redirect()->route('who-we-are.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}