<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $loggedin = false;
        if (Auth::check()) $loggedin = true;
        $featuredProducts  = Product::all();
        $title = 'Dobrodošli u Ribarnicu';
        $description = 'Najbolji izbor sveže ribe i morskih plodova direktno sa obale.';
        return view('home', compact('title', 'description', 'featuredProducts','loggedin'));
    }
}
