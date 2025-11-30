<?php

use App\Http\Controllers\about_us;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Gallery;
use App\Http\Controllers\OnamaController;

use App\Models\Fish;
use Illuminate\Support\Facades\Route;

// Početna stranica
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/prijava', [AccountController::class, 'index'])->name('llogin');
Route::get('/o-nama', [about_us::class, 'index']);


// Prijava
Route::get('/prijava', [AccountController::class, 'index'])->name('login');

// Ruta za galeriju
Route::get('/Galerija', [Gallery::class, 'index'])->name('galerija');
