<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Career;

use Carbon\Carbon;

class CareerController extends Controller
{

    public function index()
    {
        $details = Career::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.career.index', compact('details'));
    }

    public function create(Request $request)
    { 
        return view('backend.career.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'role' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'company_interview' => 'required|string',
            'location' => 'required|string|max:255',
            'job_description' => 'required|string',
            'responsibility' => 'nullable|string',
            'job_requirements' => 'required|string',
            'job_benefits' => 'nullable|string',
            'job_disclaimer' => 'nullable|string',
        ], [
            'title.max' => 'The job title must not exceed 255 characters.',
            'role.required' => 'The job role is required.',
            'role.max' => 'The job role must not exceed 255 characters.',
            'job_title.required' => 'The job title is required.',
            'company_interview.required' => 'The company overview is required.',
            'location.required' => 'The job location is required.',
            'location.max' => 'The job location must not exceed 255 characters.',
            'job_description.required' => 'The job description is required.',
            'job_requirements.required' => 'The job requirements are required.',
            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP image formats are allowed.',
            'product_image.max' => 'The image size must not exceed 2MB.',
        ]);
        

        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            $productImageName = time() . rand(10, 999) . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('uploads/career/'), $productImageName);
        }

        Career::create([
            'banner_heading' => $request->banner_heading,
            'banner_image' => $productImageName,
            'title' => $request->title,
            'role' => $request->role,
            'job_title' => $request->job_title,
            'company_overview' => $request->company_interview,
            'location' => $request->location,
            'job_description' => $request->job_description,
            'responsibilities' => $request->responsibility,
            'job_requirements' => $request->job_requirements,
            'job_benefits' => $request->job_benefits,
            'job_disclaimer' => $request->job_disclaimer,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(),
        ]);

        return redirect()->route('career.index')->with('message', 'Job created successfully!');
    }

    public function edit($id)
    {
        $details = Career::findOrFail($id);
      
        return view('backend.career.edit', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_heading' => 'nullable|string|max:255',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'title' => 'nullable|string|max:255',
            'role' => 'required|string|max:255',
            'job_title' => 'required|string|max:255',
            'company_interview' => 'required|string',
            'location' => 'required|string|max:255',
            'job_description' => 'required|string',
            'responsibility' => 'nullable|string',
            'job_requirements' => 'required|string',
            'job_benefits' => 'nullable|string',
            'job_disclaimer' => 'nullable|string',
        ], [
            'title.max' => 'The job title must not exceed 255 characters.',
            'role.required' => 'The job role is required.',
            'role.max' => 'The job role must not exceed 255 characters.',
            'job_title.required' => 'The job title is required.',
            'company_interview.required' => 'The company overview is required.',
            'location.required' => 'The job location is required.',
            'location.max' => 'The job location must not exceed 255 characters.',
            'job_description.required' => 'The job description is required.',
            'job_requirements.required' => 'The job requirements are required.',
            'product_image.image' => 'The uploaded file must be an image.',
            'product_image.mimes' => 'Only JPG, JPEG, PNG, and WEBP image formats are allowed.',
            'product_image.max' => 'The image size must not exceed 2MB.',
        ]);

        $career = Career::findOrFail($id);

        if ($request->hasFile('product_image')) {
            $productImage = $request->file('product_image');
            $productImageName = time() . rand(10, 999) . '.' . $productImage->getClientOriginalExtension();
            $productImage->move(public_path('uploads/career/'), $productImageName);
            
            $career->banner_image = $productImageName;
        }

        $career->banner_heading = $request->banner_heading;
        $career->title = $request->title;
        $career->role = $request->role;
        $career->job_title = $request->job_title;
        $career->company_overview = $request->company_interview;
        $career->location = $request->location;
        $career->job_description = $request->job_description;
        $career->responsibilities = $request->responsibility;
        $career->job_requirements = $request->job_requirements;
        $career->job_benefits = $request->job_benefits;
        $career->job_disclaimer = $request->job_disclaimer;
        $career->modified_at = Carbon::now();
        $career->modified_by = Auth::id();

        $career->save();

        return redirect()->route('career.index')->with('message', 'Job updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::id();
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = Career::findOrFail($id);
            $industries->update($data);

            return redirect()->route('career.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }


}