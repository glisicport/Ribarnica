<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Gallery;
use Illuminate\Support\Facades\Route;

// Početna stranica
Route::get('/', [HomeController::class, 'index'])->name('home');

// Prijava
Route::get('/prijava', [AccountController::class, 'index'])->name('login');

// Ruta za galeriju
Route::get('/Galerija', [Gallery::class, 'index'])->name('galerija');
