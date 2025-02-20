<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\WhoWeAre;
use App\Models\ProductVisionRange;
use App\Models\ChooseUs;
use App\Models\PreWiring;
use App\Models\ProfessionalInstall;
use App\Models\PreWiringPartB;
use App\Models\PostInstallation;
use App\Models\PostInstallPartB;
use App\Models\PostInstallPartC;
use App\Models\ResideLightPartA;
use App\Models\ResideLightPartB;
use App\Models\ResideLightPartC;
use App\Models\CommercialLightPartA;
use App\Models\CommercialLightPartB;
use App\Models\CommercialLightPartC;
use App\Models\Gallery;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ShoppingPartA;
use App\Models\ShoppingGuidePartB;
use App\Models\BlogType;
use App\Models\BlogDetails;


use Carbon\Carbon;


class AboutUsController extends Controller
{

    public function index()
    {
        $whoWeAre = WhoWeAre::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $productVisionRange = ProductVisionRange::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $chooseUsData = ChooseUs::whereNull('deleted_by')->orderBy('inserted_at', 'desc')->first();
        $productTitles = json_decode($chooseUsData->product_titles);
        $productDescriptions = json_decode($chooseUsData->product_descriptions);
        $productImages = json_decode($chooseUsData->product_images);

        return view('frontend.about', compact('whoWeAre','productVisionRange','chooseUsData', 'productTitles', 'productDescriptions', 'productImages'));
    }

    public function installation()
    {
        $installationData = ProfessionalInstall::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        return view('frontend.professional', compact('installationData'));
    }

    public function consultation()
    {
        $prewiring = PreWiring::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $prewiring_partB = PreWiringPartB::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();

        return view('frontend.prewiring', compact('prewiring','prewiring_partB'));
    }
    

    public function training()
    {
        $postinstall = PostInstallation::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $postinstall_partB = PostInstallPartB::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $postinstall_partC = PostInstallPartC::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
    
        return view('frontend.post-installation', compact('postinstall', 'postinstall_partB', 'postinstall_partC'));
    }

    
    public function residential()
    {
        $residential = ResideLightPartA::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $residential_partB = ResideLightPartB::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $residential_partC = ResideLightPartC::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();

        return view('frontend.residential-lighting', compact('residential', 'residential_partB','residential_partC'));
    }
    
    public function commercial()
    {
        $commercial = CommercialLightPartA::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $commercial_partB = CommercialLightPartB::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $commercial_partC = CommercialLightPartC::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();

        return view('frontend.commercial-lighting', compact('commercial', 'commercial_partB','commercial_partC'));
    }
    
    
    public function gallery()
    {
        $gallery = Gallery::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        
        $galleryImages = $gallery ? json_decode($gallery->gallery_images, true) : [];

        return view('frontend.gallery', compact('gallery', 'galleryImages'));
    }



    public function product_category()
    {
        $heading = ProductCategory::whereNull('deleted_by')->first();
        $categories = ProductCategory::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
        return view('frontend.product-category', compact('categories','heading'));
    }

    
    
    public function product_page($slug)
    {
        $category = ProductCategory::where('slug', $slug)->whereNull('deleted_at')->firstOrFail();
        $products = $category->products()->whereNull('deleted_at')->get();
        return view('frontend.product-main', compact('category', 'products'));
    }


    public function shopping_guide()
    {

        $guide = ShoppingPartA::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->first();
        $guide_partB = ShoppingGuidePartB::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
  
        return view('frontend.shopping-guide', compact('guide','guide_partB'));
    }
    

    public function blogs()
    {
        $blogs = BlogType::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
        return view('frontend.blogs', compact('blogs'));
    }


    public function blog_details($slug)
    {

        $blogType = BlogType::where('slug', $slug)->firstOrFail();

        $blogs = BlogDetails::with('blogType')  
            ->where('blog_title_id', $blogType->id) 
            ->whereNull('deleted_by') 
            ->orderBy('inserted_at', 'asc') 
            ->get();

        $blog_head = BlogDetails::whereNull('deleted_by')->orderBy('inserted_at', 'asc')->get();
    
        return view('frontend.blog-details', compact('blogs','blog_head'));
    }
    

    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
        ]);
    
        $emailData = [
            'email' => $validatedData['email'],
        ];
    
        Mail::send('frontend.subscription', $emailData, function ($message) use ($validatedData) {
            $message->to('riddhi@matrixbricks.com')
                    ->cc('shweta@matrixbricks.com')
                    ->subject('New Subscription')
                    ->replyTo($validatedData['email']);
        });
    
        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
    

    

        
}