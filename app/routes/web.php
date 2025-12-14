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

use App\Models\Fish;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAboutUsController;


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