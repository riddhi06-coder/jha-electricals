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

// ===================================================================Frontend================================================================


Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){

    Route::get('/', [HomeController::class, 'index'])->name('home.page');
    Route::get('/about-us', [AboutUsController::class, 'index'])->name('about-us.page');


});