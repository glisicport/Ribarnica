<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {

        $products = Product::all();
        $title = 'Dobrodošli u Ribarnicu';
        $description = 'Najbolji izbor sveže ribe i morskih plodova direktno sa obale.';
        return view('home', compact('title', 'description', 'products'));
    }
}
