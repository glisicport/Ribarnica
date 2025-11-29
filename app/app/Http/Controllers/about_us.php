<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class about_us extends Controller
{
    public function index(): View {

        // Uzimamo samo jedan zapis iz about_us
        $about = \App\Models\about_us::first();

        // Uzimamo sve zaposlene
        $employees = \App\Models\Employee::all();

        return view('about_us.index', compact('about', 'employees'));
    }
}
