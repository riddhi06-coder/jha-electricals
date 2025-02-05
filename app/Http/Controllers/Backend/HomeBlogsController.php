<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeBlog;

use Carbon\Carbon;

class HomeBlogsController extends Controller
{

    public function index()
    {
        $blogs = HomeBlog::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.blogs.index', compact('blogs'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'blog_title' => 'required|string|max:255',
            'blog_author' => 'required|string|max:255',
            'blog_date' => 'required|date',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // Max 2MB
        ], [
            'title.max' => 'The title must not exceed 255 characters.',
            'blog_title.required' => 'Please enter a Blog Title.',
            'blog_title.max' => 'The Blog Title must not exceed 255 characters.',
            'blog_author.required' => 'Please enter a Blog Author.',
            'blog_author.max' => 'The Blog Author name must not exceed 255 characters.',
            'blog_date.required' => 'Please enter a Blog Date.',
            'blog_date.date' => 'Please enter a valid date.',
            'banner_image.required' => 'Please upload a Thumbnail Image.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image size must not exceed 2MB.',
        ]);

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . rand(10, 999) . '.' . $extension;
                $destinationPath = public_path('/uploads/home/blogs');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $imageName);
            }
        }
        HomeBlog::create([
            'title' => $request->title,
            'blog_title' => $request->blog_title,
            'blog_author' => $request->blog_author,
            'blog_date' => $request->blog_date,
            'image' => $imageName ?? null, 
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);

        return redirect()->route('home-blogs.index')->with('message', 'Blog added successfully!');
    }

    public function edit($id)
    {
        $blogs = HomeBlog::findOrFail($id);
        return view('backend.home.blogs.edit', compact('blogs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'blog_title' => 'required|string|max:255',
            'blog_author' => 'required|string|max:255',
            'blog_date' => 'required|date',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'title.max' => 'The title must not exceed 255 characters.',
            'blog_title.required' => 'Please enter a Blog Title.',
            'blog_title.max' => 'The Blog Title must not exceed 255 characters.',
            'blog_author.required' => 'Please enter a Blog Author.',
            'blog_author.max' => 'The Blog Author name must not exceed 255 characters.',
            'blog_date.required' => 'Please enter a Blog Date.',
            'blog_date.date' => 'Please enter a valid date.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image size must not exceed 2MB.',
        ]);

        $blog = HomeBlog::findOrFail($id);

        if ($request->hasFile('banner_image')) {

            $image = $request->file('banner_image');
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . rand(10, 999) . '.' . $extension;
                $destinationPath = public_path('/uploads/home/blogs');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $imageName);
            }
        }

        $blog->update([
            'title' => $request->title,
            'blog_title' => $request->blog_title,
            'blog_author' => $request->blog_author,
            'blog_date' => $request->blog_date,
            'image' => $imageName ?? $blog->image, 
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('home-blogs.index')->with('message', 'Blog updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeBlog::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-blogs.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}