<?php

namespace App\Http\Controllers;
 use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class Gallery extends Controller
{

public function index()
{
    $folder = 'images/ambijent';
    $images = [];

    if (Storage::disk('public')->exists($folder)) {
        $files = Storage::disk('public')->files($folder);
        foreach ($files as $file) {
            $images[] = Storage::url($file);
        }
    }

    return view('gallery.index', compact('images'));
}

}
