<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Contact;

use Carbon\Carbon;

class ContactController extends Controller
{

    public function index()
    {
        $contact = Contact::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.contact.index', compact('contact'));
    }

    public function create(Request $request)
    { 
        return view('backend.contact.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'url' => 'required|string'
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'product_image.required' => 'Please upload a banner image.',
            'product_image.image' => 'The file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP files are allowed.',
            'product_image.max' => 'The image size must be less than 2MB.',
            'url.required' => 'The location URL is required.',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image'); 
    
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;
    
                $destinationPath = public_path('/uploads/contact/');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
    
                $image->move($destinationPath, $new_name);
    
                $imagePath = $new_name; 
            }
        }
    
        Contact::create([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $imagePath,
            'url' => $request->url,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(), 
        ]);
    
        return redirect()->route('contact.index')->with('message', 'Contact details saved successfully!');
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('backend.contact.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', 
            'url' => 'required|string'
        ], [
            'banner_heading.required' => 'The banner heading is required.',
            'product_image.image' => 'The file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP files are allowed.',
            'product_image.max' => 'The image size must be less than 2MB.',
            'url.required' => 'The location URL is required.',
        ]);

        // Handling Image Upload
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;

                $destinationPath = public_path('/uploads/contact/');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $new_name);
                $contact->banner_image = $new_name;
            }
        }

        $contact->banner_heading = $request->banner_heading;
        $contact->url = $request->url;
        $contact->modified_at = Carbon::now();
        $contact->modified_by = Auth::id();
        $contact->save();

        return redirect()->route('contact.index')->with('message', 'Contact details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Contact::findOrFail($id);
            $industries->update($data);

            return redirect()->route('contact.index')->with('message', 'Contact deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }

    
}