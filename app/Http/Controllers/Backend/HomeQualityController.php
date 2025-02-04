<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeQuality;

use Carbon\Carbon;

class HomeQualityController extends Controller
{

    public function index()
    {
        $quality = HomeQuality::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.qualities.index', compact('quality'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.qualities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'quality_icon' => 'required|array|min:1', 
            'quality_icon.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048', 
            'quality' => 'required|array|min:1',
            'quality.*' => 'required|string|max:255', 
        ], [
            'quality_icon.required' => 'Please upload at least one quality icon.',
            'quality_icon.*.image' => 'Each file must be an image.',
            'quality_icon.*.mimes' => 'Allowed formats are jpg, jpeg, png, webp.',
            'quality_icon.*.max' => 'Each image must be smaller than 2MB.',
            'quality.required' => 'Please enter at least one quality.',
            'quality.*.required' => 'Quality is required.',
        ]);

        $qualityIcons = $request->file('quality_icon');
        $qualities = $request->input('quality');

        foreach ($qualityIcons as $key => $image) {
            if ($image->isValid()) {
                $extension = $image->getClientOriginalExtension();
                $new_name = time() . rand(10, 999) . '.' . $extension;

                $destinationPath = public_path('/uploads/home/quality-icons');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image->move($destinationPath, $new_name);

                $qualityData = new HomeQuality(); 
                $qualityData->quality_icon = $new_name;
                $qualityData->quality = $qualities[$key]; 
                $qualityData->inserted_at = Carbon::now();
                $qualityData->inserted_by = Auth::id();
                $qualityData->save();
            }
        }

        return redirect()->route('home-quality.index')->with('message', 'Quality details created successfully!');
    }

    public function edit($id)
    {
        $quality = HomeQuality::findOrFail($id);
        return view('backend.home.qualities.edit', compact('quality'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quality_icon.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'quality.*' => 'required|string|max:255',
        ], [
            'quality_icon.*.image' => 'Each file must be an image.',
            'quality_icon.*.mimes' => 'Allowed formats are jpg, jpeg, png, webp.',
            'quality_icon.*.max' => 'Each image must be smaller than 2MB.',
            'quality.required' => 'Please enter at least one quality.',
            'quality.*.required' => 'Quality is required.',
        ]);
    
        $quality = HomeQuality::findOrFail($id);
        
        foreach ($request->quality as $index => $qualityText) {
            if (isset($request->quality_icon[$index])) {
                $file = $request->file('quality_icon')[$index];
                
                if ($file && $file->isValid()) {
                    $extension = $file->getClientOriginalExtension();
                    $newName = time() . rand(10, 999) . '.' . $extension;
                    $destinationPath = public_path('/uploads/home/quality-icons');
    
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
    
                    $file->move($destinationPath, $newName);
    
                    $quality->quality_icon = $newName;
                }
            }
    
            $quality->quality = $qualityText;
    
            $quality->save();
        }
    
        return redirect()->route('home-quality.index')->with('message', 'Quality updated successfully!');
    }
    
    
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();   
        try {
            $industries = HomeQuality::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-quality.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
    

}