<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        ProductCategory::create($validated);

        return redirect()->back()->with('success', 'Kategorija je uspešno dodata!');
    }

    public function update(Request $request, ProductCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name,' . $category->id,
            'slug' => 'nullable|string|max:255|unique:product_categories,slug,' . $category->id
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $category->update($validated);

        return redirect()->back()->with('success', 'Kategorija je uspešno ažurirana!');
    }

    public function destroy(ProductCategory $category)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Ne možete obrisati kategoriju koja ima proizvode!');
        }

        $category->delete();

        return redirect()->back()->with('success', 'Kategorija je uspešno obrisana!');
    }
}