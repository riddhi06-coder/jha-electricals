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


use Carbon\Carbon;

class HomeController extends Controller
{

    public function index()
    {
        $banners = HomeBanner::orderBy('inserted_at', 'asc')->whereNull('deleted_by')->get();
        $homeAbout = HomeAbout::whereNull('deleted_by')->first();
        $homeFounder = HomeFounder::whereNull('deleted_by')->first(); 
        return view('frontend.home', compact('banners', 'homeAbout', 'homeFounder'));
    }
    
    

}