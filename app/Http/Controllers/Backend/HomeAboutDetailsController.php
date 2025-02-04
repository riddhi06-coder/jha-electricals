<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeAbout;

use Carbon\Carbon;

class HomeAboutDetailsController extends Controller
{

    public function index()
    {
        $about = HomeAbout::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.about.index', compact('about'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.about.create');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',  
            'thumbnail_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'value.*' => 'nullable|string|max:255',
            'value_description.*' => 'nullable|string|max:500',
        ], [
            'heading.required' => 'The heading is required.',
            'description.required' => 'The description is required.',
            'thumbnail_image.*.image' => 'The uploaded file must be an image.',
            'thumbnail_image.*.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the image.',
            'thumbnail_image.*.max' => 'The image must be less than 2MB.',
        ]);
    
        $homeAbout = new HomeAbout();
        $homeAbout->heading = $request->heading;
        
        $homeAbout->description = $request->description;
        
        $values = $request->input('value', []);
        $values_description = $request->input('value_description', []);
        
        $valuesArray = array_filter($values, function ($value) {
            return !empty($value);
        });
    
        $descriptionsArray = array_filter($values_description, function ($desc) {
            return !empty($desc);
        });
    
        $homeAbout->value = json_encode($valuesArray);
        $homeAbout->value_description = json_encode($descriptionsArray);
    
        if ($request->hasFile('thumbnail_image')) {
            $images = $request->file('thumbnail_image');
            $imagePaths = [];
    
            foreach ($images as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;
    
                    $destinationPath = public_path('/uploads/home/about');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
    
                    $image->move($destinationPath, $new_name);
    
                    $imagePaths[] = $new_name;
                }
            }
    
            $homeAbout->images = json_encode($imagePaths);
        }
    
        $homeAbout->inserted_at = Carbon::now();
        $homeAbout->inserted_by = Auth::id();
        $homeAbout->save();
    
        return redirect()->route('home-about.index')->with('message', 'Data saved successfully!');
    }

    public function edit($id)
    {
        $about = HomeAbout::findOrFail($id);
        $values = json_decode($about->value); 
        $valueDescriptions = json_decode($about->value_description); 
        $images = json_decode($about->images); 
        return view('backend.home.about.edit', compact('about', 'values', 'valueDescriptions','images'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'thumbnail_image.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'value.*' => 'nullable|string|max:255',
            'value_description.*' => 'nullable|string',
        ], [
            'heading.required' => 'The heading is required.',
            'description.required' => 'The description is required.',
            'thumbnail_image.*.image' => 'The uploaded file must be an image.',
            'thumbnail_image.*.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed for the image.',
            'thumbnail_image.*.max' => 'The image must be less than 2MB.',
        ]);

        $homeAbout = HomeAbout::findOrFail($id);

        $homeAbout->heading = $request->heading;
        $homeAbout->description = $request->description;

        $values = $request->input('value', []);
        $values_description = $request->input('value_description', []);
    
        $valuesArray = array_filter($values, function ($value) {
            return !empty($value);
        });
    
        $descriptionsArray = array_filter($values_description, function ($desc) {
            return !empty($desc);
        });
    
        $homeAbout->value = json_encode($valuesArray);
        $homeAbout->value_description = json_encode($descriptionsArray);
    
        $existingImages = $request->input('existing_images', []);

        $removedImages = $request->input('removed_images', []);

        $updatedImages = array_diff($existingImages, $removedImages);

        if ($request->hasFile('thumbnail_image')) {
            $newImages = $request->file('thumbnail_image');
            $newImagePaths = [];

            foreach ($newImages as $image) {
                if ($image->isValid()) {
                    $extension = $image->getClientOriginalExtension();
                    $new_name = time() . rand(10, 999) . '.' . $extension;

                    $destinationPath = public_path('/uploads/home/about');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }

                    $image->move($destinationPath, $new_name);
                    $newImagePaths[] = $new_name;
                }
            }

            $allImagePaths = array_merge($updatedImages, $newImagePaths);
        } else {
            $allImagePaths = $updatedImages;
        }

        $homeAbout->images = json_encode($allImagePaths);

        $homeAbout->modified_at = Carbon::now();
        $homeAbout->modified_by = Auth::id();
        $homeAbout->save();
    
        return redirect()->route('home-about.index')->with('message', 'Data updated successfully!');
    }


    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();   
        try {
            $industries = HomeAbout::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-about.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
    
    
    
    
    
}