<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeTestimonial;

use Carbon\Carbon;

class HomeTestimonailController extends Controller
{

    public function index()
    {
        $testimonail = HomeTestimonial::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.testimonial.index', compact('testimonail'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.testimonial.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'title.max' => 'The title must not exceed 255 characters.',
            'name.required' => 'Please enter the reviewer\'s name.',
            'name.max' => 'The reviewer\'s name must not exceed 255 characters.',
            'message.required' => 'Please enter a message.',
            'banner_image.required' => 'Please upload an image.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image size must not exceed 2MB.',
        ]);
    
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
    
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . rand(10, 999) . '.' . $extension;
    
                $destinationPath = public_path('/uploads/testimonials');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true); 
                }
    
                $image->move($destinationPath, $imageName);
            }
        }
       
        HomeTestimonial::create([
            'title' => $request->title,
            'name' => $request->name,
            'message' => $request->message,
            'image' => $imageName ?? null,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);
    
        return redirect()->route('home-testimonails.index')->with('message', 'Testimonial added successfully!');
    }

    public function edit($id)
    {
        $testimonail = HomeTestimonial::findOrFail($id);
        return view('backend.home.testimonial.edit', compact('testimonail'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'title.max' => 'The title must not exceed 255 characters.',
            'name.required' => 'Please enter the reviewer\'s name.',
            'name.max' => 'The reviewer\'s name must not exceed 255 characters.',
            'message.required' => 'Please enter a message.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image size must not exceed 2MB.',
        ]);

        $testimonial = HomeTestimonial::findOrFail($id);

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');

            if ($image->isValid()) {

                $extension = $image->getClientOriginalExtension();
                $imageName = time() . rand(10, 999) . '.' . $extension;
                $destinationPath = public_path('/uploads/testimonials');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $imageName);
                $testimonial->image = $imageName;
            }
        }
        // dd($request->message);
        $testimonial->update([
            'title' => $request->title,
            'name' => $request->name,
            'message' => $request->message,
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('home-testimonails.index')->with('message', 'Testimonial updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeTestimonial::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-testimonails.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    

}