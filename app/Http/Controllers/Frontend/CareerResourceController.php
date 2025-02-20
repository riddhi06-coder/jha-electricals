<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Career;

use Carbon\Carbon;

class CareerResourceController extends Controller
{

    public function career()
    {
        $career = Career::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
        return view('frontend.career', compact('career'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/'],
            'phone' => ['required', 'digits:10'],
            'subject' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'resume' => ['required', 'mimes:pdf', 'max:2048']
        ], [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a valid text.',
            'name.max' => 'The name must not exceed 255 characters.',
        
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.regex' => 'Invalid email format.',
            'email.max' => 'The email must not exceed 255 characters.',
        
            'phone.required' => 'The phone number field is required.',
            'phone.digits' => 'The phone number must be exactly 10 digits.',
        
            'subject.required' => 'The subject field is required.',
            'subject.string' => 'The subject must be a valid text.',
            'subject.max' => 'The subject must not exceed 255 characters.',
        
            'position.required' => 'The position field is required.',
            'position.string' => 'The position must be a valid text.',
            'position.max' => 'The position must not exceed 255 characters.',
        
            'resume.required' => 'Please upload a resume.',
            'resume.mimes' => 'Only PDF files are allowed.',
            'resume.max' => 'The resume file must not exceed 2MB.'
        ]);
        

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->move(public_path('uploads/resume'), $request->file('resume')->getClientOriginalName());
            $resumeFullPath = public_path("uploads/resume/{$request->file('resume')->getClientOriginalName()}");
        } else {
            return back()->with('error', 'Resume upload failed.');
        }

        Mail::send('frontend.career_mail', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'position' => $request->position,
        ], function ($message) use ($request, $resumeFullPath) {
            $message->from('customercare@jhaelectricals.com', 'Jha Electricals')
                ->to('riddhi@matrixbricks.com')
                ->subject('New Job Application - ' . $request->position)
                ->attach($resumeFullPath);
        });

        return redirect()->route('thank.you');
    }
}
