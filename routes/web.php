<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use App\Http\Controllers\Backend\HomeBannerDetailsController;
use App\Http\Controllers\Backend\HomeAboutDetailsController;
use App\Http\Controllers\Backend\HomeFounderDetailsController;
use App\Http\Controllers\Backend\HomeRangeDetailsController;
use App\Http\Controllers\Backend\HomeQualityController;
use App\Http\Controllers\Backend\HomeContactController;
use App\Http\Controllers\Backend\HomeTestimonailController;
use App\Http\Controllers\Backend\HomeBlogsController;
use App\Http\Controllers\Backend\HomeFooterController;
use App\Http\Controllers\Backend\SocialMediaController;
use App\Http\Controllers\Backend\WhoUsController;
use App\Http\Controllers\Backend\VisionControllerController;
use App\Http\Controllers\Backend\ChooseControllerController;
use App\Http\Controllers\Backend\ProfessionalInstallationController;
use App\Http\Controllers\Backend\PreWiringController;
use App\Http\Controllers\Backend\PostInstallController;
use App\Http\Controllers\Backend\PreWiringPartBController;
use App\Http\Controllers\Backend\PostInstallPartBController;
use App\Http\Controllers\Backend\PostInstallPartCController;
use App\Http\Controllers\Backend\ResideLightPartAController;
use App\Http\Controllers\Backend\ResideLightPartBController;
use App\Http\Controllers\Backend\ResideLightPartCController;
use App\Http\Controllers\Backend\CommercialLightPartAController;
use App\Http\Controllers\Backend\CommercialLightPartBController;
use App\Http\Controllers\Backend\CommercialLightPartCController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\CareerController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductDetailController;
use App\Http\Controllers\Backend\ShoppingGuideController;
use App\Http\Controllers\Backend\ShoppingGuidePartBController;
use App\Http\Controllers\Backend\BlogTypesController;
use App\Http\Controllers\Backend\BlogDetailsController;
use App\Http\Controllers\Backend\PrivacyController;
use App\Http\Controllers\Backend\SwitchCategoryController;
use App\Http\Controllers\Backend\SwitchController;
use App\Http\Controllers\Backend\SwitchDetailController;
use App\Http\Controllers\Backend\AccesoriesCategoryController;
use App\Http\Controllers\Backend\AccesoriesController;
use App\Http\Controllers\Backend\AccesoriesDetailController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\MasterProductController;
use App\Http\Controllers\Backend\MasterProductDetailsController;
use App\Http\Controllers\Backend\MasterWireDetailsController;


use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\CareerResourceController;
use App\Http\Controllers\Frontend\ContactUsController;
use App\Http\Controllers\Frontend\ProductDetailsController;

use App\Models\MasterProduct;
use Illuminate\Support\Facades\Log;

// Route::get('/', function () {
//     return view('frontend.home');
// });
  
// Authentication Routes
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');

// Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard'); 
    })->name('admin.dashboard');
});


// ==== Manage Banner Details in Home
Route::resource('home-banner', HomeBannerDetailsController::class);

// ==== Manage About Details in Home
Route::resource('home-about', HomeAboutDetailsController::class);

// ==== Manage About Founder Details in Home
Route::resource('home-founder', HomeFounderDetailsController::class);

// ==== Manage About Range Details in Home
Route::resource('home-range', HomeRangeDetailsController::class);

// ==== Manage About quality Details in Home
Route::resource('home-quality', HomeQualityController::class);

// ==== Manage About contact Details in Home
Route::resource('home-contact', HomeContactController::class);

// ==== Manage About Testimonails Details in Home
Route::resource('home-testimonails', HomeTestimonailController::class);

// ==== Manage About Blogs Details in Home
Route::resource('home-blogs', HomeBlogsController::class);

// ==== Manage About Company Details Details in Home
Route::resource('home-footer', HomeFooterController::class);

// ==== Manage About Social Media Details in Home
Route::resource('social-media', SocialMediaController::class);


// ==== Manage About Us Banner details
Route::resource('who-we-are', WhoUsController::class);

// ==== Manage About Us Vision details
Route::resource('product-vision', VisionControllerController::class);

// ==== Manage Why choose details
Route::resource('choose-us', ChooseControllerController::class);


// ==== Manage Profeesional Installation in Service & support
Route::resource('professional-install', ProfessionalInstallationController::class);

// ==== Manage Pre-Wiring Consultation in Service & support
Route::resource('pre-wiring', PreWiringController::class);

// ==== Manage Pre-Wiring Consultation Part B in Service & support
Route::resource('pre-wiring-partB', PreWiringPartBController::class);

// ==== Manage Post Installation in Service & support
Route::resource('post-install', PostInstallController::class);

// ==== Manage Post Installation Part B in Service & support
Route::resource('post-install-partB', PostInstallPartBController::class);

// ==== Manage Post Installation Part C in Service & support
Route::resource('post-install-partC', PostInstallPartCController::class);

// ==== Manage Residential Lighting Part A in Application Area
Route::resource('reside-light-partA', ResideLightPartAController::class);

// ==== Manage Residential Lighting Part B in Application Area
Route::resource('reside-light-partB', ResideLightPartBController::class);

// ==== Manage Residential Lighting Part C in Application Area
Route::resource('reside-light-partC', ResideLightPartCController::class);

// ==== Manage Commercial Lighting Part A in Application Area
Route::resource('commercial-light-partA', CommercialLightPartAController::class);

// ==== Manage Commercial Lighting Part B in Application Area
Route::resource('commercial-light-partB', CommercialLightPartBController::class);

// ==== Manage Commercial Lighting Part C in Application Area
Route::resource('commercial-light-partC', CommercialLightPartCController::class);

// ==== Manage Gallery
Route::resource('gallery', GalleryController::class);

// ==== Manage Career Resources
Route::resource('career', CareerController::class);

// ==== Manage Contact
Route::resource('contact', ContactController::class);


// ==== Shopping Guide
Route::resource('guide', ShoppingGuideController::class);

// ==== Shopping Guide
Route::resource('guide-partB', ShoppingGuidePartBController::class);



// // ==== Manage Product Category in Products Section
// Route::resource('product-category', ProductCategoryController::class);

// // ==== Manage Product Category in Products Section
// Route::resource('add-products',ProductsController::class);

// // ==== Manage Product Category in Products Section
// Route::resource('product-detail',ProductDetailController::class);



// // ==== Manage Switch Category in Products Section
// Route::resource('switch-product-category', SwitchCategoryController::class);

// // ==== Manage Switch Category in Products Section
// Route::resource('switch-add-products',SwitchController::class);

// // ==== Manage Switch Category in Products Section
// Route::resource('switch-product-detail',SwitchDetailController::class);



// // ==== Manage Accesories Category in Products Section
// Route::resource('accessories-product-category', AccesoriesCategoryController::class);

// // ==== Manage Accesories Category in Products Section
// Route::resource('accessories-add-products',AccesoriesController::class);

// // ==== Manage Accesories Category in Products Section
// Route::resource('accessories-product-detail',AccesoriesDetailController::class);


// // ==== Manage Wires Category in Products Section
// Route::resource('wires-product-category', WiresCategoryController::class);

// // ==== Manage Wires Category in Products Section
// Route::resource('wires-add-products',WiresController::class);

// // ==== Manage Wires Category in Products Section
// Route::resource('wires-product-detail',WiresDetailController::class);



// ==== Manage Category in Products Section
Route::resource('category', CategoryController::class);

// ==== Manage Category in Products Section
Route::resource('sub-category', SubCategoryController::class);

// ==== Manage Add Products in Products Section
Route::resource('master-products', MasterProductController::class);
Route::get('/get-subcategories', [MasterProductController::class, 'getSubcategories'])->name('get.subcategories');

// ==== Manage Product Details in Products Section
Route::resource('master-product-details', MasterProductDetailsController::class);
Route::get('/get-subcategories', [MasterProductDetailsController::class, 'getSubcategories'])->name('get.subcategories');
Route::get('/get-products', [MasterProductDetailsController::class, 'getProducts'])->name('get.products');

// ==== Manage Wires Details in Products Section
Route::resource('wire-details', MasterWireDetailsController::class);
Route::get('/get-subcategories', [MasterWireDetailsController::class, 'getSubcategories'])->name('get.subcategories');
Route::get('/get-products', [MasterWireDetailsController::class, 'getProducts'])->name('get.products');


// ==== Manage Blogs Types in BLogs Section
Route::resource('blog-types',BlogTypesController::class);

// ==== Manage BLog Details in BLogs Section
Route::resource('blog-detail',BlogDetailsController::class);

// ==== Manage Privacy Policy Page
Route::resource('privacy',PrivacyController::class);



// ===================================================================Frontend================================================================
Route::get('/search-products', function (Request $request) {
    $query = $request->query('query');

    if (!$query) {
        Log::info("Search query is missing!");
        return response()->json(['error' => 'No search query provided'], 400);
    }

    Log::info("Search query received: " . $query);

    $products = MasterProduct::where('product_name', 'LIKE', "%{$query}%")
        ->whereNull('deleted_by')
        ->get();

    Log::info("Products found: " . $products->count());

    return response()->json($products);
})->name('search.products'); // Add an explicit route name


Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    
    Route::get('/home', [HomeController::class, 'index'])->name('home.page');
    Route::get('/privacy-policy', [HomeController::class, 'privacy_policy'])->name('privacy.policy');
    Route::get('/thank-you', [HomeController::class, 'thankyou'])->name('thank.you');
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.page');
    Route::get('/professional-installation', [AboutUsController::class, 'installation'])->name('professional.installation');
    Route::get('/prewiring-consultation', [AboutUsController::class, 'consultation'])->name('prewiring.consultation');
    Route::get('/postinstallation-training', [AboutUsController::class, 'training'])->name('postinstallation.training');
    Route::get('/residential-lighting', [AboutUsController::class, 'residential'])->name('residential.lighting');
    Route::get('/commercial-lighting', [AboutUsController::class, 'commercial'])->name('commercial.lighting');
    Route::get('/career-resources', [CareerResourceController::class, 'career'])->name('career.resources');
    Route::post('/career/apply', [CareerResourceController::class, 'store'])->name('career.apply');
    Route::get('/contact-us', [ContactUsController::class, 'contact'])->name('contact.us');
    Route::post('/contact-store', [ContactUsController::class, 'store'])->name('contact.us.store');
    Route::post('/subscribe', [AboutUsController::class, 'subscribe'])->name('subscribe');
    Route::get('/photo-gallery', [AboutUsController::class, 'gallery'])->name('photo.gallery');
    Route::get('/shopping-guide', [AboutUsController::class, 'shopping_guide'])->name('shopping.guide');
    Route::get('/blogs', [AboutUsController::class, 'blogs'])->name('blogs');
    Route::post('/submit-enquiry', [ProductDetailsController::class, 'submitEnquiry'])->name('enquiry.submit');
    Route::get('/blog-details/{slug}', [AboutUsController::class, 'blog_details'])->name('blog.details');

    Route::get('/products', [AboutUsController::class, 'product_category'])->name('products.category');
    Route::get('/{slug}', [AboutUsController::class, 'product_page'])->name('product.page');
    Route::get('/product-details/{slug}', [ProductDetailsController::class, 'details'])->name('product-details');


    
    
});