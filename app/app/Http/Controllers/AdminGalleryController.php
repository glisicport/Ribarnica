<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Gallery;
use Intervention\Image\Facades\Image; 


class AdminGalleryController extends Controller
{
    // ===== INDEX =====
    public function index()
    {
        // Dohvati sve slike iz baze
        $images = Gallery::all();

        return view('admin.gallery.index', compact('images'));
    }

    // ===== STORE =====
    public function store(Request $request)
    {
        $request->validate([
            'naziv_slike' => 'required|string|max:255',
            'kategorija' => 'required|string|in:Enterijer,Eksterijer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $image = $request->file('image');
        $naziv = $request->input('naziv_slike');
        $kategorija = strtolower($request->input('kategorija')); // eksterijer / enterijer

        // Napravi finalni naziv fajla sa prefiksom kategorije
        $fileName = $kategorija . '_' . Str::slug($naziv) . '.' . $image->getClientOriginalExtension();

        // Kreiraj folder ako ne postoji
        Storage::disk('public')->makeDirectory('images/ambijent');

        // Snimi fajl u storage/app/public/images/ambijent
        $image->storeAs('images/ambijent', $fileName, 'public');

        // Sačuvaj u bazu
        $gallery = new Gallery();
        $gallery->naziv_slike = $fileName;
        $gallery->putanja = 'storage/images/ambijent/' . $fileName;
        $gallery->save();

        return redirect()->back()->with('success', 'Slika je uspešno dodata!');
    }

    // ===== DELETE =====
  public function destroy($fileName)
{
    // Putanja do fajla
    $path = storage_path('app/public/images/ambijent/' . $fileName);

    // Proveri da li fajl postoji, i ako postoji obriši ga
    if (file_exists($path)) {
        unlink($path);
        $fileMessage = 'Slika je obrisana sa servera i iz baze.';
    } else {
        $fileMessage = 'Fajl nije pronađen na disku, ali zapis u bazi je obrisan.';
    }

    // Obriši zapis iz baze
    $image = \App\Models\Gallery::where('naziv_slike', $fileName)->first();
    if ($image) {
        $image->delete();
    }

    return redirect()->back()->with('success', $fileMessage);
}



    // ===== UPDATE =====
public function update(Request $request, $fileName)
{
    $request->validate([
        'image' => 'required|file'
    ]);

    $folder = storage_path('app/public/images/ambijent');
    $oldPath = $folder . '/' . $fileName;

    if (!file_exists($oldPath)) {
        return back()->with('error', 'Originalna slika ne postoji u folderu.');
    }

    $uploadedFile = $request->file('image');
    $mime = $uploadedFile->getMimeType();

    // Brišemo staru sliku
    unlink($oldPath);

    // PUTANJA NOVE (ISTI NAZIV)
    $newPath = $oldPath;

    /* =============================
       FORMAT KOJI GD MOŽE
    ============================== */
    if (
        in_array($mime, ['image/png', 'image/gif', 'image/webp']) &&
        function_exists('imagecreatefromstring')
    ) {
        $imageData = file_get_contents($uploadedFile->getRealPath());
        $image = imagecreatefromstring($imageData);

        if (!$image) {
            return back()->with('error', 'Neuspešno učitavanje slike.');
        }

        imagepng($image, $newPath);
        imagedestroy($image);
    }
   
    else {
        move_uploaded_file($uploadedFile->getRealPath(), $newPath);
    }

    // Update baze ako postoji zapis
    $gallery = \App\Models\Gallery::where('naziv_slike', $fileName)->first();
    if ($gallery) {
        $gallery->putanja = 'storage/images/ambijent/' . $fileName;
        $gallery->save();
    }

    return back()->with('success', 'Slika je uspešno zamenjena.');
}


    public function rename(Request $request, $fileName)
{
    $stariNaziv = $fileName;
    $noviNaziv = $request->input('novi_naziv');

    $folder = storage_path('app/public/images/ambijent/');

    $staraPutanja = $folder . $stariNaziv;
    $novaPutanja = $folder . $noviNaziv . '.' . pathinfo($stariNaziv, PATHINFO_EXTENSION);

    // Provera da li fajl postoji
    if (!file_exists($staraPutanja)) {
        return back()->with('error', 'Originalni fajl ne postoji.');
    }

    // Provera da li novi fajl već postoji
    if (file_exists($novaPutanja)) {
        return back()->with('error', 'Fajl sa tim imenom već postoji.');
    }

    try {
        rename($staraPutanja, $novaPutanja);

        // Takođe update u bazi
        $image = \App\Models\Gallery::where('naziv_slike', $stariNaziv)->first();
        if ($image) {
            $image->naziv_slike = $noviNaziv;
            $image->putanja = 'storage/images/ambijent/' . $noviNaziv . '.' . pathinfo($stariNaziv, PATHINFO_EXTENSION);
            $image->save();
        }

        return back()->with('success', 'Slika je uspešno preimenovana.');

    } catch (\Exception $e) {
        return back()->with('error', 'Došlo je do greške prilikom preimenovanja slike: ' . $e->getMessage());
    }
}

}
