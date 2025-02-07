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
use App\Models\WhoWeAre;

use Carbon\Carbon;

class ProfessionalInstallationController extends Controller
{

    public function index()
    {
        return view('backend.services.training.index');
    }

    public function create(Request $request)
    { 
        return view('backend.services.training.create');
    }
}