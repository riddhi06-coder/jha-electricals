<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeFounder;

use Carbon\Carbon;

class HomeFounderDetailsController extends Controller
{

    public function index()
    {
        $founder = HomeFounder::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.founder.index', compact('founder'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.founder.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_description' => 'required|string',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', // 2MB limit
        ], [
            'banner_title.required' => 'The banner title is required.',
            'banner_description.required' => 'The banner description is required.',
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',
        ]);
    
        $founder = new HomeFounder();
        $founder->title = $request->banner_title;
        $founder->description = $request->banner_description;
        $founder->inserted_at = Carbon::now();
        $founder->inserted_by = Auth::id();
    
    
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image'); 
        
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;
        
                $destinationPath = public_path('/uploads/home/founder');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
    
                $image->move($destinationPath, $new_name);
                $founder->image = $new_name;
            }
        }
        
        $founder->save();
    
        return redirect()->route('home-founder.index')->with('message', 'Details created successfully!');
    }

    public function edit($id)
    {
        $founder = HomeFounder::findOrFail($id);
        return view('backend.home.founder.edit', compact('founder'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_description' => 'required|string',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'banner_title.required' => 'The banner title is required.',
            'banner_description.required' => 'The banner description is required.',
            'banner_image.image' => 'The uploaded file must be an image.',
            'banner_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'banner_image.max' => 'The image must be less than 2MB.',
        ]);
    
        $founder = HomeFounder::findOrFail($id);
    
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
    
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;
    
                $destinationPath = public_path('/uploads/home/founder');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
    
                $image->move($destinationPath, $new_name);
                $founder->image = $new_name; 
            }
        }

        $founder->description = $request->banner_description;
        $founder->title = $request->banner_title;
        $founder->modified_at = Carbon::now(); 
        $founder->modified_by = Auth::id(); 
    
        $founder->save();
    
        return redirect()->route('home-founder.index')->with('message', 'Details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeFounder::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-founder.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    

}