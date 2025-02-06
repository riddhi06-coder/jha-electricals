<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\WhoWeAre;
use App\Models\ProductVisionRange;


use Carbon\Carbon;

class AboutUsController extends Controller
{

    public function index()
    {
        $whoWeAre = WhoWeAre::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $productVisionRange = ProductVisionRange::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();

        return view('frontend.about', compact('whoWeAre','productVisionRange'));
    }

    
}