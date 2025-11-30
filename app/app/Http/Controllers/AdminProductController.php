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
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'product_categories_id' => 'required|exists:product_categories,id',
            'file_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload slike - Updated to use 'uploads/images'
        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('uploads/images', 'public');
        }

        Product::create($validated);

        return redirect()->back()->with('success', 'Proizvod je uspešno dodat!');
    }

    /**
     * Ažurira proizvod
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'product_categories_id' => 'required|exists:product_categories,id',
            'file_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Upload nove slike - Updated to use 'uploads/images'
        if ($request->hasFile('file_path')) {
            // Obriši staru sliku
            if ($product->file_path) {
                Storage::disk('public')->delete($product->file_path);
            }
            $validated['file_path'] = $request->file('file_path')->store('uploads/images', 'public');
        }

        $product->update($validated);

        return redirect()->back()->with('success', 'Proizvod je uspešno ažuriran!');
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