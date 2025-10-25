<?php

use App\Models\Fish;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $fish = Fish::all();
    return view('home', ['fish' => $fish]);

});
