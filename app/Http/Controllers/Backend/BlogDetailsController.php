<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\BlogType;
use App\Models\BlogDetails;

use Carbon\Carbon;

class BlogDetailsController extends Controller
{

    public function index()
    {
        $details = BlogDetails::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.blogs.blog-details.index', compact('details'));
    }

    public function create(Request $request)
    { 
        $blogs = BlogType::whereNull('deleted_by')->get();
        return view('backend.blogs.blog-details.create', compact('blogs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'blog_title' => 'required|exists:blog_types,id', 
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description' => 'required|string|max:9000',
        ], [
            'product_image.required' => 'The banner image is required.',
            'product_image.image' => 'The banner image must be a valid image file.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the banner image.',
            'product_image.max' => 'The banner image size must be less than 2MB.',
            'image.required' => 'The image is required.',
            'image.image' => 'The image must be a valid image file.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the image.',
            'image.max' => 'The image size must be less than 2MB.',
            'description.required' => 'The description field is required.',
        ]);

        // Store Banner Image
        if ($request->hasFile('product_image')) {
            $bannerImage = $request->file('product_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/blogs/'), $bannerImageName);
        }

        // Store Image (Blog Image)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs/'), $imageName);
        }

        BlogDetails::create([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $bannerImageName ?? null,
            'blog_title_id' => $request->blog_title,
            'image' => $imageName ?? null,
            'description' => $request->description,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);

        return redirect()->route('blog-detail.index')->with('message', 'Blog details added successfully.');
    }

    public function edit($id)
    {
        $details = BlogDetails::findOrFail($id);
        $blogs = BlogType::whereNull('deleted_by')->get(); 
        return view('backend.blogs.blog-details.edit', compact('details', 'blogs'));
    }
    


    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',  
            'blog_title' => 'required|exists:blog_types,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',  
            'description' => 'required|string|max:9000',
        ], [
            'product_image.image' => 'The banner image must be a valid image file.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the banner image.',
            'product_image.max' => 'The banner image size must be less than 2MB.',
            'image.image' => 'The image must be a valid image file.',
            'image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the image.',
            'image.max' => 'The image size must be less than 2MB.',
            'description.required' => 'The description field is required.',
        ]);

        $details = BlogDetails::findOrFail($id);

        // Store Banner Image (Only if a new one is uploaded)
        if ($request->hasFile('product_image')) {
            
            $bannerImage = $request->file('product_image');
            $bannerImageName = time() . rand(10, 999) . '.' . $bannerImage->getClientOriginalExtension();
            $bannerImage->move(public_path('uploads/blogs/'), $bannerImageName);
        } else {
            $bannerImageName = $details->banner_image;
        }

        // Store Blog Image (Only if a new one is uploaded)
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = time() . rand(10, 999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs/'), $imageName);
        } else {
            $imageName = $details->image;
        }

        $details->update([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $bannerImageName,
            'blog_title_id' => $request->blog_title,
            'image' => $imageName,
            'description' => $request->description,
            'updated_at' => Carbon::now(),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('blog-detail.index')->with('message', 'Blog details updated successfully.');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = BlogDetails::findOrFail($id);
            $industries->update($data);

            return redirect()->route('blog-detai.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    
}