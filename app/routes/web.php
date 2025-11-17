<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OnamaController;

use App\Models\Fish;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/prijava', [AccountController::class, 'index'])->name('llogin');
Route::get('/o-nama', [OnamaController::class, 'index']);


