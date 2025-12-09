<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\about_us;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
{
    $page = $request->query('page_type', 'products');


    $productsQuery = Product::with('category');

    if ($request->filled('search')) {
        $search = $request->input('search');
        $productsQuery->where(function($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }

    if ($request->filled('category')) {
        $productsQuery->where('product_categories_id', $request->input('category'));
    }

    $products = $productsQuery->orderBy('created_at', 'desc')
                              ->paginate(6)
                              ->appends($request->query());


    $categoriesQuery = ProductCategory::withCount('products');

    if ($request->filled('category_search')) {
        $search = $request->input('category_search');
        $categoriesQuery->where('name', 'like', "%{$search}%");
    }

    $categories = $categoriesQuery->orderBy('name')
                                  ->paginate(12, ['*'], 'categories_page')
                                  ->appends($request->query());

    $allCategories = ProductCategory::orderBy('name')->get();

    $about = about_us::first();

    return view("admin.index", compact('page', 'products', 'categories', 'allCategories','about'));
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('prijava')->with('status', 'Uspešno ste se odjavili.');
    }
}