<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\about_us;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OnamaController;

use App\Models\Fish;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAboutUsController;


// Admin namespace controllers
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\ContactInfoController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/o-nama', [about_us::class, 'index'])->name('o-nama');
Route::get('/proizvodi', [ProductsController::class, 'index'])->name('proizvodi');
Route::get('/galerija', [Gallery::class, 'index'])->name('galerija');
Route::get('/stara-prijava', [AccountController::class, 'index'])->name('llogin');

// Kontakt – frontend (korisnici)
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// AUTH (LOGIN)
Route::get('/prijava', [AuthController::class, 'index'])->name('prijava');
Route::post('/prijava', [AuthController::class, 'login'])->name('prijava.login');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Odjava
    Route::post('/odjava', [AuthController::class, 'logout'])->name('odjava');

    // Kontrolni panel sa GET parametrom page_type
    Route::get('/kontrolni-panel', [AdminDashboardController::class, 'index'])->name('kontrolni-panel');

    // CRUD operacije za page_type resources (faq, quick-facts, questions)
    Route::post('/kontrolni-panel/{resource}', [AdminDashboardController::class, 'store'])->name('kontrolni-panel.store');
    Route::put('/kontrolni-panel/{resource}/{id}', [AdminDashboardController::class, 'update'])->name('kontrolni-panel.update');
    Route::delete('/kontrolni-panel/{resource}/{id}', [AdminDashboardController::class, 'destroy'])->name('kontrolni-panel.destroy');

    // Korisnički nalog
    Route::get('/korisnicki-nalog', [UserDashboardController::class, 'index'])->name('korisnicki-nalog');

    /*
    |--------------------------------------------------------------------------
    | ADMIN PREFIX /admin
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->name('admin.')->group(function () {

        // Pitanja korisnika (kontakt poruke)
        Route::get('/questions', [AdminContactMessageController::class, 'index'])->name('questions.index');
        Route::post('/questions/{id}/answer', [AdminContactMessageController::class, 'answer'])->name('questions.answer');
        Route::delete('/questions/{id}', [AdminContactMessageController::class, 'destroy'])->name('questions.destroy');

        // Kontakt informacije (hero blok na /contact)
        Route::get('/contact-info', [ContactInfoController::class, 'edit'])->name('contact-info.edit');
        Route::put('/contact-info', [ContactInfoController::class, 'update'])->name('contact-info.update');

        // Proizvodi i kategorije (API deo za admin panel)
        Route::resource('products', AdminProductController::class)
            ->except(['show', 'index', 'create', 'edit']);

        Route::resource('categories', AdminCategoryController::class)
            ->except(['show', 'index', 'create', 'edit']);
        
        // Proizvodi (all CRUD operations)
        Route::resource('products', AdminProductController::class)->except(['show', 'index', 'create', 'edit']);
        
        // Kategorije (all CRUD operations)
        Route::resource('categories', AdminCategoryController::class)->except(['show', 'index', 'create', 'edit']);

        Route::resource('employees', App\Http\Controllers\AdminEmployeeController::class);

        Route::resource('employees', App\Http\Controllers\AdminEmployeeController::class)->except(['show', 'create', 'edit']);

           Route::get('/about', [AdminAboutUsController::class, 'index'])->name('about');
        Route::put('/about', [AdminAboutUsController::class, 'update'])->name('about.update');


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

    // Admin Dashboard (Unified dashboard with products and categories)
    Route::get('/kontrolni-panel', [AdminDashboardController::class, 'index'])->name('kontrolni-panel');

    // Korisnički nalog
    Route::get('/korisnicki-nalog', [UserDashboardController::class, 'index'])->name('korisnicki-nalog');
    
    // ==========================================
    // ADMIN - PROIZVODI & KATEGORIJE (CRUD)
    // ==========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Proizvodi (all CRUD operations)
        Route::resource('products', AdminProductController::class)->except(['show', 'index', 'create', 'edit']);
        
        // Kategorije (all CRUD operations)
        Route::resource('categories', AdminCategoryController::class)->except(['show', 'index', 'create', 'edit']);
        
    });
});
