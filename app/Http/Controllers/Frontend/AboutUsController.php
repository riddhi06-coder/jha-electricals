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
use App\Models\ChooseUs;


use Carbon\Carbon;

class AboutUsController extends Controller
{

    public function index()
    {
        $whoWeAre = WhoWeAre::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $productVisionRange = ProductVisionRange::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $chooseUsData = ChooseUs::orderBy('inserted_at', 'desc')->first();
        $productTitles = json_decode($chooseUsData->product_titles);
        $productDescriptions = json_decode($chooseUsData->product_descriptions);
        $productImages = json_decode($chooseUsData->product_images);

        return view('frontend.about', compact('whoWeAre','productVisionRange','chooseUsData', 'productTitles', 'productDescriptions', 'productImages'));
    }

    
}