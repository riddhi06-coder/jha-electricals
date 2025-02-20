<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\PrivacyPolicy;

use Carbon\Carbon;

class PrivacyController extends Controller
{

    public function index()
    {
        $privacy = PrivacyPolicy::whereNull('deleted_by')->get();
        return view('backend.privacy.index', compact('privacy'));
    }

    public function create(Request $request)
    { 
        return view('backend.privacy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'required|string|max:255',
            'product_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'privacy_policy' => 'required|string',
        ], [
            'banner_heading.required' => 'The Banner Heading.',
            'product_image.required' => 'Please upload a banner image.',
            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP formats are allowed.',
            'product_image.max' => 'The image must be less than 2MB.',
            'privacy_policy.required' => 'The privacy policy is required.',
        ]);

        $privacy = new PrivacyPolicy();
        $privacy->banner_heading = $request->banner_heading;
        $privacy->privacy_policy = $request->privacy_policy;
        $privacy->inserted_at = Carbon::now();
        $privacy->inserted_by = Auth::id();

        // Handle image upload
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . rand(10, 999) . '.' . $extension;

                $destinationPath = public_path('/uploads/privacy');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $image->move($destinationPath, $imageName);
                $privacy->banner_image = $imageName;
            }
        }

        $privacy->save();

        return redirect()->route('privacy.index')->with('message', 'Privacy policy created successfully!');
    }

    public function edit($id)
    {
        $privacy = PrivacyPolicy::findOrFail($id);
        return view('backend.privacy.edit', compact('privacy'));
    }

}