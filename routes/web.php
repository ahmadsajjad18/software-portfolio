<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;



Route::get('/',[FrontendController::class,'dashboard'])->name('main.page');

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('home')->group(function () {
        Route::get('dashboard',       [HomeController::class, 'dashboard'])->name('home.dashboard');
        Route::post('store',          [HomeController::class, 'store'])->name('home.store');
        Route::post('update',         [HomeController::class, 'update'])->name('home.update');
        Route::get('get-home/{id}',   [HomeController::class, 'getHome']);
        Route::get('index',           [HomeController::class,'index'])->name('home.index');
        Route::delete('delete/{id}',  [HomeController::class, 'destroy'])->name('home.destroy');
    });

    Route::prefix('about')->group(function () {
        Route::get('/dashboard',      [AboutController::class, 'dashboard'])->name('about.dashboard');
        Route::post('/store',         [AboutController::class, 'store'])->name('about.store');
        Route::get('/download-cv',    [AboutController::class, 'downloadCV'])->name('about.download-cv');
        Route::get('get-about/{id}',  [AboutController::class, 'getAbout']);
        Route::get('/edit/{id}',      [AboutController::class, 'edit'])->name('about.edit');
        Route::post('/update/{id}',   [AboutController::class, 'update'])->name('about.update');
        Route::delete('/delete/{id}', [AboutController::class, 'destroy'])->name('about.destroy');
    });

    Route::prefix('service')->group(function() {
        Route::get('dashboard',       [ServiceController::class, 'dashboard'])->name('service.dashboard');
        Route::get('edit/{id}',       [ServiceController::class, 'edit'])->name('service.edit');
        Route::post('store',          [ServiceController::class, 'store'])->name('service.store');
        Route::post('update/{id}',    [ServiceController::class, 'update'])->name('service.update');
        Route::delete('delete/{id}',  [ServiceController::class, 'destroy'])->name('service.destroy');
    });

    Route::prefix('portfolio')->group(function() {
        Route::get('dashboard',       [PortfolioController::class, 'dashboard'])->name('portfolio.dashboard');
        Route::get('edit/{id}',       [PortfolioController::class, 'edit'])->name('portfolio.edit');
        Route::post('store',          [PortfolioController::class, 'store'])->name('portfolio.store');
        Route::post('update/{id}',    [PortfolioController::class, 'update'])->name('portfolio.update');
        Route::delete('delete/{id}',  [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    });

    Route::prefix('socialLink')->group(function() {
        Route::get('dashboard',       [SocialLinkController::class, 'dashboard'])->name('socialLink.dashboard');
        Route::get('edit/{id}',       [SocialLinkController::class, 'edit'])->name('socialLink.edit');
        Route::post('store',          [SocialLinkController::class, 'store'])->name('socialLink.store');
        Route::post('update/{id}',    [SocialLinkController::class, 'update'])->name('socialLink.update');
        Route::delete('delete/{id}',  [SocialLinkController::class, 'destroy'])->name('socialLink.destroy');
    });

    Route::prefix('testimonial')->group(function() {
        Route::get('dashboard',       [TestimonialController::class, 'dashboard'])->name('testimonial.dashboard');
        Route::get('edit/{id}',       [TestimonialController::class, 'edit'])->name('testimonial.edit');
        Route::post('store',          [TestimonialController::class, 'store'])->name('testimonial.store');
        Route::post('update/{id}',    [TestimonialController::class, 'update'])->name('testimonial.update');
        Route::delete('delete/{id}',  [TestimonialController::class, 'destroy'])->name('testimonial.destroy');
    });

    // web.php

    Route::prefix('contacts')->group(function () {
        Route::get('dashboard', [ContactController::class, 'dashboard'])->name('contact.dashboard');
        Route::get('/messages', [ContactController::class, 'getMessages']);
        Route::delete('/{id}', [ContactController::class, 'destroy']);
    });

});
Route::post('contact/store',          [ContactController::class, 'store'])->name('contact.store');


require __DIR__.'/auth.php';
