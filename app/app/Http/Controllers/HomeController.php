<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $loggedin = false;
        if (Auth::check()) $loggedin = true;
        
        // Get recommended products based on login status and order history
        $featuredProducts = $this->getRecommendedProducts();
        
        $title = 'Dobrodošli u Ribarnicu';
        $description = 'Najbolji izbor sveže ribe i morskih plodova direktno sa obale.';
        return view('home', compact('title', 'description', 'featuredProducts','loggedin'));
    }

    /**
     * Get recommended products based on user's order history or random selection
     * Returns 10 products with recommendation algorithm
     */
    private function getRecommendedProducts()
    {
        $recommendedProducts = collect();

        if (Auth::check()) {
            // User is logged in - get recommendations based on order history
            $userId = Auth::id();
            
            // Get all products user has ordered
            $userOrderedProducts = OrderItem::whereHas('order', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->with('product')
            ->get()
            ->pluck('product')
            ->unique('id')
            ->values();

            if ($userOrderedProducts->count() > 0) {
                // User has order history - recommend their ordered products
                $recommendedProducts = $userOrderedProducts->take(10);

                // If user has less than 10 ordered products, fill with random products
                if ($recommendedProducts->count() < 4) {
                    $orderedProductIds = $userOrderedProducts->pluck('id')->toArray();
                    $additionalProducts = Product::whereNotIn('id', $orderedProductIds)
                        ->inRandomOrder()
                        ->limit(4 - $recommendedProducts->count())
                        ->get();
                    
                    $recommendedProducts = $recommendedProducts->merge($additionalProducts);
                }
            } else {
                // User has no order history - recommend random products
                $recommendedProducts = Product::inRandomOrder()
                    ->limit(5)
                    ->get();
            }
        } else {
            // User is not logged in - get random products
            $recommendedProducts = Product::inRandomOrder()
                ->limit(10)
                ->get();
        }

        // Ensure we return exactly 10 products (or less if not enough in database)
        return $recommendedProducts->take(10);
    }
}
