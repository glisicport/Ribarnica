<?php

namespace App\Http\Controllers;

use App\Models\Product;

class AccountController extends Controller
{
    public function index()
    {

        $products = Product::all();

        return view('login');
    }
}
