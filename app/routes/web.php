<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OnamaController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Prijava
Route::get('/prijava', [AuthController::class, 'index'])->name('prijava');
Route::post('/prijava', [AuthController::class, 'login'])->name('prijava.login');

// Proizvodi
Route::get('/proizvodi', [ProductsController::class, 'index'])->name('proizvodi');

// Kontrolni panel (Admin dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/kontrolni-panel', [AdminDashboardController::class, 'index'])->name('kontrolni-panel');

    // Odjava
    Route::post('/odjava', [AdminDashboardController::class, 'logout'])->name('odjava');

    // Korisnički nalog
    Route::get('/korisnicki-nalog', [UserDashboardController::class, 'index'])->name('korisnicki-nalog');
});
