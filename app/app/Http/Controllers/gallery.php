<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Gallery extends Controller
{
    public function index()
    {
        // Folder u public
        $folder = public_path('images/ambijent');
        $images = [];

        // Provera da li folder postoji
        if(is_dir($folder)) {
            // Uzmi sve jpg, png, webp fajlove
            $files = glob($folder.'/*.{jpg,jpeg,png,webp,JPG,JPEG,PNG,WEBP}', GLOB_BRACE);
            foreach($files as $file){
                $images[] = basename($file);
            }
        }

        return view('gallery.index', compact('images'));
    }
}
