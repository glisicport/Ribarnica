<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory; 
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Prikazuje listu proizvoda sa filtriranjem, pretragom i sortiranjem.
     */
    public function index(Request $request)
    {
        // Uključujemo relaciju 'category' za efikasnost (Eager Loading)
        $query = Product::with('category'); 

        // 1. FILTRIRANJE PO KATEGORIJI (Koristeći slug i relaciju)
        if ($request->filled('category')) {
            $categorySlug = $request->category;

            $query->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        // 2. PRETRAGA PO IMENU
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 3. FILTRIRANJE PO CENI
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // 4. SORTIRANJE
        $sort = $request->input('sort');

        switch ($sort) {
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                // Default sortiranje po ID-u (kao najnovije)
                $query->orderBy('id', 'desc');
                break;
        }

        // 5. Paginacija
        // Koristimo withQueryString() da bismo sačuvali sve filtere/sortiranja prilikom promene stranice
        $products = $query->paginate(6)->withQueryString();

        // Slanje svih kategorija u view
        $categories = ProductCategory::all();

        return view('products', compact('products', 'categories'));
    }
}