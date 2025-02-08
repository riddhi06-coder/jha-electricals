<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
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


use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutUsController;

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



// ===================================================================Frontend================================================================


Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    Route::get('/', [HomeController::class, 'index'])->name('home.page');
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.page');
    Route::get('/professional-installation', [AboutUsController::class, 'installation'])->name('professional.installation');
    Route::get('/prewiring-consultation', [AboutUsController::class, 'consultation'])->name('prewiring.consultation');
    Route::get('/postinstallation-training', [AboutUsController::class, 'training'])->name('postinstallation.training');

});