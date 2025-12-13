<?php

use App\Http\Controllers\about_us;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\OnamaController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\AdminAboutUsController;
use App\Http\Controllers\AdminGalleryController;

// ==========================================
// PUBLIC ROUTES
// ==========================================

// Početna stranica
Route::get('/', [HomeController::class, 'index'])->name('home');

// O nama
Route::get('/o-nama', [about_us::class, 'index'])->name('o-nama');

// Prijava
Route::get('/prijava', [AuthController::class, 'index'])->name('prijava');
Route::post('/prijava', [AuthController::class, 'login'])->name('prijava.login');

// Proizvodi (javni pregled)
Route::get('/proizvodi', [ProductsController::class, 'index'])->name('proizvodi');

// Galerija
Route::get('/Galerija', [Gallery::class, 'index'])->name('galerija');

// ==========================================
// AUTHENTICATED ROUTES
// ==========================================
Route::middleware(\App\Http\Middleware\Authenticate::class )->group(function () {
    
    // Odjava
    Route::post('/odjava', [AdminDashboardController::class, 'logout'])->name('odjava');

    // Admin Dashboard
    Route::get('/kontrolni-panel', [AdminDashboardController::class, 'index'])->name('kontrolni-panel');

    // Korisnički nalog
    Route::get('/korisnicki-nalog', [UserDashboardController::class, 'index'])->name('korisnicki-nalog');
    
    // ==========================================
    // ADMIN - PROIZVODI, KATEGORIJE, ZAPOSLENI, O NAMA
    // ==========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Proizvodi
        Route::resource('products', AdminProductController::class)->except(['show', 'index', 'create', 'edit']);
        
        // Kategorije
        Route::resource('categories', AdminCategoryController::class)->except(['show', 'index', 'create', 'edit']);

        // Zaposleni
        Route::resource('employees', App\Http\Controllers\AdminEmployeeController::class)->except(['show', 'create', 'edit']);

        // O NAMA
        Route::get('/about', [AdminAboutUsController::class, 'index'])->name('about');
        Route::put('/about', [AdminAboutUsController::class, 'update'])->name('about.update');

        // ==========================================
        // ADMIN – GALERIJA (CRUD)
        // ==========================================
        Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::put('/gallery/update/{fileName}', [AdminGalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/delete/{fileName}', [AdminGalleryController::class, 'destroy'])->name('gallery.delete');

        // NOVA RUTA: Rename slike
        Route::put('/gallery/rename/{fileName}', [AdminGalleryController::class, 'rename'])->name('gallery.rename');

    });
});

// ==========================================
// ROUTE ZA SERVIRANJE SLIKA IZ FOLDERA
// ==========================================
Route::get('gallery-image/{filename}', function ($filename) {
    $path = storage_path('app/public/images/ambijent/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return Response::make($file, 200)->header("Content-Type", $type);
})->where('filename', '.*');
