<?php

use App\Http\Controllers\about_us;
use App\Http\Controllers\OnamaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutUs;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAboutUsController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\AdminEmployeeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/o-nama', [about_us::class, 'index'])->name('o-nama');
Route::get('/proizvodi', [ProductsController::class, 'index'])->name('proizvodi');
Route::get('/galerija', [Gallery::class, 'index'])->name('galerija');
Route::get('/stara-prijava', [AccountController::class, 'index'])->name('llogin');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/prijava', [AuthController::class, 'index'])->name('prijava');
Route::post('/prijava', [AuthController::class, 'login'])->name('prijava.login');
Route::get('/registracija', [AuthController::class, 'registerShow'])->name('registracija');
Route::post('/registracija', [AuthController::class, 'register'])->name('registracija.store');

Route::middleware(['auth'])->group(function () {
    Route::post('/odjava', [AuthController::class, 'logout'])->name('odjava');

    Route::get('/kontrolni-panel', [AdminDashboardController::class, 'index'])->name('kontrolni-panel');
    Route::post('/kontrolni-panel/{resource}', [AdminDashboardController::class, 'store'])->name('kontrolni-panel.store');
    Route::put('/kontrolni-panel/{resource}/{id}', [AdminDashboardController::class, 'update'])->name('kontrolni-panel.update');
    Route::delete('/kontrolni-panel/{resource}/{id}', [AdminDashboardController::class, 'destroy'])->name('kontrolni-panel.destroy');

    Route::get('/korisnicki-nalog', [UserDashboardController::class, 'index'])->name('korisnicki-nalog');
    Route::get('/profil/uredi', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('/profil/uredi', [ProfileController::class, 'update'])->name('profil.update');
    Route::get('/profil/promena-lozinke', [ProfileController::class, 'changePasswordShow'])->name('profil.change-password');
    Route::put('/profil/promena-lozinke', [ProfileController::class, 'changePassword'])->name('profil.change-password.update');

    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/order/success/{id}', [CartController::class, 'orderSuccess'])->name('order.success');
    Route::get('/order/history', [CartController::class, 'orderHistory'])->name('order.history');
    Route::get('/order/{id}', [CartController::class, 'orderDetail'])->name('order.detail');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/questions', [AdminContactMessageController::class, 'index'])->name('questions.index');
        Route::post('/questions/{id}/answer', [AdminContactMessageController::class, 'answer'])->name('questions.answer');
        Route::delete('/questions/{id}', [AdminContactMessageController::class, 'destroy'])->name('questions.destroy');

        Route::get('/contact-info', [ContactInfoController::class, 'edit'])->name('contact-info.edit');
        Route::put('/contact-info', [ContactInfoController::class, 'update'])->name('contact-info.update');

        Route::resource('products', AdminProductController::class)->except(['show', 'index', 'create', 'edit']);
        Route::resource('categories', AdminCategoryController::class)->except(['show', 'index', 'create', 'edit']);
        Route::resource('employees', AdminEmployeeController::class)->except(['show', 'create', 'edit']);

        Route::get('/about', [AdminAboutUsController::class, 'index'])->name('about');
        Route::put('/about', [AdminAboutUsController::class, 'update'])->name('about.update');

        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::post('/orders/{id}/confirm', [AdminOrderController::class, 'confirmOrder'])->name('orders.confirm');
    });
});
