<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeContact;

use Carbon\Carbon;

class HomeContactController extends Controller
{

    public function index()
    {
        $contact = HomeContact::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.contact.index', compact('contact'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'banner_title.required' => 'Please enter a title.',
            'banner_heading.required' => 'Please enter a heading.',
            'banner_image.required' => 'Please upload a banner image.',
            'banner_image.image' => 'The file must be an image.',
            'banner_image.mimes' => 'The image must be in one of the following formats: jpg, jpeg, png, webp.',
            'banner_image.max' => 'The image size must be less than 2MB.',
        ]);
    
        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image'); 
            
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;
    
                $destinationPath = public_path('/uploads/home/contact');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true); 
                }
    
                $image->move($destinationPath, $new_name);
            }
        }
    
        HomeContact::create([
            'title' => $request->banner_title,
            'heading' => $request->banner_heading,
            'image' => $new_name ?? null, 
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
      
        ]);
    
        return redirect()->route('home-contact.index')->with('message', 'Details created successfully!');
    }
    
    public function edit($id)
    {
        $contact = HomeContact::findOrFail($id);
        return view('backend.home.contact.edit', compact('contact'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_title' => 'required|string|max:255',
            'banner_heading' => 'required|string|max:255',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
        ], [
            'banner_title.required' => 'Please enter a title.',
            'banner_heading.required' => 'Please enter a heading.',
            'banner_image.image' => 'The file must be an image.',
            'banner_image.mimes' => 'The image must be in one of the following formats: jpg, jpeg, png, webp.',
            'banner_image.max' => 'The image size must be less than 2MB.',
        ]);

        $contact = HomeContact::findOrFail($id);

        $contact->title = $request->banner_title;
        $contact->heading = $request->banner_heading;

        if ($request->hasFile('banner_image')) {
            $image = $request->file('banner_image');
            
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;

                $destinationPath = public_path('/uploads/home/contact');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true); 
                }

                $image->move($destinationPath, $new_name);

                $contact->image = $new_name; 
            }
        }
        $contact->modified_at = Carbon::now();
        $contact->modified_by = Auth::id();

        $contact->save(); 

        return redirect()->route('home-contact.index')->with('message', 'Details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeContact::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-contact.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

}