<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
}
