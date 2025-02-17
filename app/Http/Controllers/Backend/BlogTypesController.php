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

use Carbon\Carbon;

class BlogTypesController extends Controller
{

    public function index()
    {
        $details = BlogType::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.blogs.blog-types.index', compact('details'));
    }

    public function create(Request $request)
    { 
        return view('backend.blogs.blog-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'blog_heading' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
        ], [
            'product_image.required' => 'The banner image is required.',
            'product_image.image' => 'The banner image must be a valid image file.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the banner image.',
            'product_image.max' => 'The banner image size must be less than 2MB.',
            'thumbnail.required' => 'The thumbnail image is required.',
            'thumbnail.image' => 'The thumbnail must be a valid image file.',
            'thumbnail.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the thumbnail.',
            'thumbnail.max' => 'The thumbnail size must be less than 2MB.',
            'date.required' => 'The date field is required.',
            'location.required' => 'The location field is required.',
            'blog_heading.required' => 'The blog heading field is required.',
            'short_description.required' => 'The short description field is required.',
        ]);

        // Store Product Image
        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            $productImageName = time() . rand(10, 999) . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('uploads/blogs/'), $productImageName);
        }

        // Store Thumbnail Image
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . rand(10, 999) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('uploads/blogs/'), $thumbnailName);
        }

        $slug = Str::slug($request->blog_heading, '-');

        BlogType::create([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $productImageName ?? null,
            'thumbnail' => $thumbnailName ?? null,
            'date' => $request->date,
            'slug' => $slug,
            'location' => $request->location,
            'blog_heading' => $request->blog_heading,
            'short_description' => $request->short_description,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);

        return redirect()->route('blog-types.index')->with('message', 'Blog type created successfully.');
    }

}