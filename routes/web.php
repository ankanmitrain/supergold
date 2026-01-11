<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[App\Http\Controllers\PageController::class,'LandingPage']);

Route::get('/about-us', [App\Http\Controllers\PageController::class,'AboutUsPage']);
Route::get('/contract-us',[App\Http\Controllers\PageController::class,'ContractUsPage']);
Route::get('/schemes', [App\Http\Controllers\PageController::class,'SchemesPage']);
Route::get('/old-resault', [App\Http\Controllers\PageController::class,'OldResaultPage'])->name('oldlotteryresault');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Login
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login.submit');

    // Admin Protected Routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('/pages', App\Http\Controllers\PageController::class);

        Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

         // Profile
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])
        ->name('profile');
        Route::post('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])
        ->name('profile.update');

        Route::resource('/uploadpdf', App\Http\Controllers\Admin\UploadPDFController::class);

        Route::get('/generatepdf', [\App\Http\Controllers\Admin\GeneratePDF::class, 'GeneratePDF'])
        ->name('generatepdf');

         Route::get('/generatepdf-mobile', [\App\Http\Controllers\Admin\GeneratePDF::class, 'GeneratePDFMobile'])
        ->name('generatepdfmobile');

        Route::post('/save-pdfdata', [\App\Http\Controllers\Admin\GeneratePDF::class, 'storePDFData']);

         Route::get('/downloadpdf', [\App\Http\Controllers\Admin\GeneratePDF::class, 'downloadMobilePdf'])
        ->name('downloadpdf');

        


    });
});


require __DIR__.'/auth.php';
