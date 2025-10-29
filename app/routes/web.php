<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Models\Fish;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/prijava', [AccountController::class, 'index'])->name('llogin');

