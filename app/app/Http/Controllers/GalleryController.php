<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\gallery; // tvoj model sa malim slovom

class GalleryController extends Controller
{
    // Prikaz svih slika
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

        return view('admin.galleryy.index', compact('images'));
    }

    // Upload i snimanje nove slike
    public function store(Request $request)
    {
        $request->validate([
            'naziv_slike' => 'required|string|max:255',
            'opis' => 'nullable|string',
            'slika' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Snimanje fajla u storage
        $putanja = $request->file('slika')->store('public/images/ambijent');

        // Snimanje u bazu
        $galerija = new gallery();
        $galerija->naziv_slike = $request->naziv_slike;
        $galerija->opis = $request->opis;
        $galerija->putanja = $putanja;
        $galerija->save();

        return redirect()->back()->with('success', 'Slika je dodata!');
    }
}
