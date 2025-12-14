<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Čuva novi proizvod u bazi
     */public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'product_categories_id' => 'required|exists:product_categories,id',
        'stock' => 'required|integer|min:0',
        'file_path' => 'nullable|image|mimes:jpeg,png,webp|max:20480'
    ]);

    // Upload slike
    if ($request->hasFile('file_path')) {
        $validated['file_path'] = $request->file('file_path')->store('uploads/images', 'public');
    }

    Product::create($validated);

    return redirect()->back()->with('success', 'Proizvod je uspešno dodat!');
}

public function update(Request $request, Product $product)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'product_categories_id' => 'required|exists:product_categories,id',
            'stock' => 'required|integer|min:0',
            'file_path' => 'nullable|image|mimes:jpeg,png,webp|max:20480'
        ]);

        // Upload nove slike
        if ($request->hasFile('file_path')) {
            // Obriši staru sliku ako postoji
            if ($product->file_path) {
                Storage::disk('public')->delete($product->file_path);
            }

            // Sačuvaj novu sliku
            $validated['file_path'] = $request->file('file_path')->store('uploads/images', 'public');
        }

        $product->update($validated);

        return redirect()->back()->with('success', 'Proizvod je uspešno ažuriran!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Vraća greške validacije
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput()
            ->with('error', 'Proizvod nije ažuriran zbog grešaka u unosu!');
    } catch (\Exception $e) {
        // Generalna greška
        return redirect()->back()
            ->withInput()
            ->with('error', 'Došlo je do greške prilikom ažuriranja proizvoda: ' . $e->getMessage());
    }
}


    /**
     * Briše proizvod
     */
    public function destroy(Product $product)
    {
        // Obriši sliku ako postoji
        if ($product->file_path) {
            Storage::disk('public')->delete($product->file_path);
        }

        $product->delete();

        return redirect()->back()->with('success', 'Proizvod je uspešno obrisan!');
    }
}