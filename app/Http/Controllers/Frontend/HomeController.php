<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HomeBanner;
use App\Models\HomeAbout;
use App\Models\HomeFounder;
use App\Models\HomeRange;
use App\Models\HomeQuality;
use App\Models\HomeContact;
use App\Models\HomeTestimonial;
use App\Models\HomeBlog;

use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        $banners = HomeBanner::orderBy('inserted_at', 'asc')->whereNull('deleted_by')->get();
        $homeAbout = HomeAbout::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $homeFounder = HomeFounder::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $homeRange = HomeRange::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
        $homeQualities = HomeQuality::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
        $homeContact = HomeContact::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $homeTestimonials = HomeTestimonial::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
        $homeBlogs = HomeBlog::orderBy('inserted_at', 'desc')->whereNull('deleted_by')->get();
    
        return view('frontend.home', compact('banners', 'homeAbout', 'homeFounder', 'homeRange', 'homeQualities', 'homeContact', 'homeTestimonials', 'homeBlogs'));
    }
    
}