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
use App\Models\Contact;
use App\Models\HomeFooter;
use Carbon\Carbon;

class ContactUsController extends Controller
{
    
    public function contact()
    {
        $contact = Contact::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $footer = HomeFooter::whereNull('deleted_by')->orderBy('inserted_at', 'desc')->first(); 
    
        return view('frontend.contact', compact('contact', 'footer'));
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/'],
            'phone_number' => ['required', 'digits:10'],
            'msg_subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:1000'],
        ]);
        
        Mail::send('frontend.contact_mail', [
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'msg_subject' => $request->msg_subject,
            'message_content' => $request->message,
        ], function ($message) use ($request) {
            $message->from('customercare@jhaelectricals.com', 'Jha Electricals')
                ->to('riddhi@matrixbricks.com')
                ->subject('New Contact Form Submission - ' . $request->msg_subject);
        });
    
        return back()->with('success', 'Your message has been sent successfully.');
    }
    
    

}