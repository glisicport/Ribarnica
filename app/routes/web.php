<?php

use App\Http\Controllers\about_us;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\OnamaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAboutUsController;
use App\Http\Controllers\AdminOrderController;


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

// Registracija
Route::get('/registracija', [AuthController::class, 'registerShow'])->name('registracija');
Route::post('/registracija', [AuthController::class, 'register'])->name('registracija.store');

// Proizvodi (javni pregled)
Route::get('/proizvodi', [ProductsController::class, 'index'])->name('proizvodi');

// Galerija
Route::get('/Galerija', [Gallery::class, 'index'])->name('galerija');

// ==========================================
// AUTHENTICATED ROUTES
// ==========================================

Route::middleware(\App\Http\Middleware\Authenticate::class )->group(function () {
     Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/order/success/{id}', [CartController::class, 'orderSuccess'])->name('order.success');
    Route::get('/order/history', [CartController::class, 'orderHistory'])->name('order.history');
    Route::get('/order/{id}', [CartController::class, 'orderDetail'])->name('order.detail');

    // Odjava
    Route::post('/odjava', [AdminDashboardController::class, 'logout'])->name('odjava');

    // Admin Dashboard (Unified dashboard with products and categories)
    Route::get('/kontrolni-panel', [AdminDashboardController::class, 'index'])->name('kontrolni-panel');

    // Korisnički nalog
    Route::get('/korisnicki-nalog', [UserDashboardController::class, 'index'])->name('korisnicki-nalog');
    
    // Profil
    Route::get('/profil/uredi', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/uredi', [ProfileController::class, 'update'])->name('profil.update');
    Route::get('/profil/promena-lozinke', [ProfileController::class, 'changePasswordShow'])->name('profil.change-password');
    Route::put('/profil/promena-lozinke', [ProfileController::class, 'changePassword'])->name('profil.change-password.update');
    
    // ==========================================
    // ADMIN - PROIZVODI & KATEGORIJE (CRUD)
    // ==========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Porudžbine - Detail and actions
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::post('/orders/{id}/confirm', [AdminOrderController::class, 'confirmOrder'])->name('orders.confirm');
        
        // Proizvodi (all CRUD operations)
        Route::resource('products', AdminProductController::class)->except(['show', 'index', 'create', 'edit']);
        
        // Kategorije (all CRUD operations)
        Route::resource('categories', AdminCategoryController::class)->except(['show', 'index', 'create', 'edit']);

        Route::resource('employees', App\Http\Controllers\AdminEmployeeController::class);

        Route::resource('employees', App\Http\Controllers\AdminEmployeeController::class)->except(['show', 'create', 'edit']);

           Route::get('/about', [AdminAboutUsController::class, 'index'])->name('about');
        Route::put('/about', [AdminAboutUsController::class, 'update'])->name('about.update');


        
    });
});