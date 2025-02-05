<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeFooter;

use Carbon\Carbon;

class HomeFooterController extends Controller
{

    public function index()
    {
        $details = HomeFooter::orderBy('id', 'desc')->whereNull('deleted_by')->get();
        return view('backend.home.footer.index', compact('details'));
    }

    public function create(Request $request)
    { 
        return view('backend.home.footer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'contact_number' => 'required',
            'address' => 'required|string',
            'blog_time' => 'required', 
        ], [
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'contact_number.required' => 'Please enter a contact number.',
            'address.required' => 'Please enter an address.',
            'blog_time.required' => 'Please enter the time.',
        ]);

        HomeFooter::create([
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'time' => $request->blog_time,
            'inserted_at' => Carbon::now(),
            'inserted_by' => Auth::id(), 
        ]);

        return redirect()->route('home-footer.index')->with('message', 'Footer details added successfully!');
    }

    public function edit($id)
    {
        $footer = HomeFooter::findOrFail($id);
        return view('backend.home.footer.edit', compact('footer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'contact_number' => 'required',
            'address' => 'required|string',
            'blog_time' => 'required', 
        ], [
            'email.required' => 'Please enter an email address.',
            'email.email' => 'Please enter a valid email address.',
            'contact_number.required' => 'Please enter a contact number.',
            'address.required' => 'Please enter an address.',
            'blog_time.required' => 'Please enter the time.',
        ]);

        $footer = HomeFooter::findOrFail($id);

        $footer->update([
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'time' => $request->blog_time,
            'modified_at' => Carbon::now(),
            'modified_by' => Auth::id(),
        ]);

        return redirect()->route('home-footer.index')->with('message', 'Footer details updated successfully!');
    }

    public function destroy(string $id)
    {
        $data['deleted_by'] =  Auth::user()->id;
        $data['deleted_at'] =  Carbon::now();
        try {
            $industries = HomeFooter::findOrFail($id);
            $industries->update($data);

            return redirect()->route('home-footer.index')->with('message', 'Details deleted successfully!');
        } catch (Exception $ex) {
            return redirect()->back()->with('error', 'Something Went Wrong - ' . $ex->getMessage());
        }
    }



}