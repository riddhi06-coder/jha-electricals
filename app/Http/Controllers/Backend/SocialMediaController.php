<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\SocialMedia;

use Carbon\Carbon;

class SocialMediaController extends Controller
{

    public function index()
    {
        $media = SocialMedia::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.social.index', compact('media'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.social.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'social_media_platform.*' => 'required|string',   
            'social_media_url.*' => 'required|url',            
        ], [
            'social_media_platform.*.required' => 'Please select a social media platform.',
            'social_media_url.*.required' => 'Please enter a valid URL for the platform.',
            'social_media_url.*.url' => 'Please enter a valid URL.',
        ]);

        foreach ($request->social_media_platform as $index => $platform) {
            SocialMedia::create([
                'platform' => $platform,
                'url' => $request->social_media_url[$index],
                'inserted_at' => Carbon::now(),
                'inserted_by' => Auth::id(), 
            ]);
        }

        return redirect()->route('social-media.index')->with('message', 'Social media links added successfully!');
    }

    public function edit($id)
    {
        $media = SocialMedia::find($id);  
        
        if (!$media) {
            return redirect()->route('social-media.index')->withErrors(['message' => 'Social media record not found.']);
        }
        $socialMediaLinks = SocialMedia::where('id', $id)->get();
    
        return view('backend.home.social.edit', compact('media', 'socialMediaLinks'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'social_media_platform.*' => 'required|string',
            'social_media_url.*' => 'required|url',
        ], [
            'social_media_platform.*.required' => 'Please select a social media platform.',
            'social_media_url.*.required' => 'Please enter a valid URL for the platform.',
            'social_media_url.*.url' => 'Please enter a valid URL.',
        ]);
    
        foreach ($request->social_media_platform as $index => $platform) {
            $socialMediaId = $request->social_media_id[$index];
    
            if ($socialMediaId) {
                $socialMedia = SocialMedia::find($socialMediaId);
                $socialMedia->update([
                    'platform' => $platform,
                    'url' => $request->social_media_url[$index],
                    'updated_at' => Carbon::now(),
                    'updated_by' => Auth::id(),
                ]);
            }
        }
    
        return redirect()->route('social-media.index')->with('message', 'Social media links updated successfully!');
    }
    
  
    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = SocialMedia::findOrFail($id);
            $industries->update($data);

            return redirect()->route('social-media.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }
    
}