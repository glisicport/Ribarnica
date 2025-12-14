<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Dohvati sve kategorije iz baze
        $categoryIds = DB::table('product_categories')
            ->pluck('id', 'name');

        $products = [
            // Morsko
            [
                'category' => 'morsko',
                'name' => 'Svež losos',
                'price' => 1890,
                'description' => 'Norveški losos premium kvaliteta',
                'file_path' => 'uploads/images/dZWSmmXQ0rzwxTqGWRJcc2FBk4t0zgVhESVBTuRm.jpg',
                'stock' => 12.5,
            ],
            [
                'category' => 'morsko',
                'name' => 'Tuna steak',
                'price' => 2490,
                'description' => 'Svež žutoperajni tuna steak',
                'file_path' => 'uploads/images/71A5GCepjYDguXC72C13nHIHIfDTKYcobcVUjHGH.webp',
                'stock' => 8.3,
            ],

            // Bela riba
            [
                'category' => 'bela riba',
                'name' => 'Oslić',
                'price' => 890,
                'description' => 'Bela riba blagog ukusa, idealna za pečenje',
                'file_path' => 'uploads/images/igyCXFXTxQxEBi6Cu504Gn9H2ZqAmXv8HLhvIkzN.jpg',
                'stock' => 10.0,
            ],
            [
                'category' => 'bela riba',
                'name' => 'Som',
                'price' => 1490,
                'description' => 'Svež rečni som vrhunskog kvaliteta',
                'file_path' => 'uploads/images/WS6lPdwZq8S9S27JZhip950zkl1RyUT8EYyQuOri.jpg',
                'stock' => 7.5,
            ],

            // Plava riba
            [
                'category' => 'plava riba',
                'name' => 'Skuša',
                'price' => 690,
                'description' => 'Masna riba intenzivnog ukusa',
                'file_path' => 'uploads/images/jIc7xVRdSbAE1hUAkg7Fuh0vUv9EiTgx1klTMT9c.jpg',
                'stock' => 15.0,
            ],
            [
                'category' => 'plava riba',
                'name' => 'Sardina',
                'price' => 490,
                'description' => 'Jadranska sardina, dnevno ulovljena',
                'file_path' => 'uploads/images/cNVl7jhCNQyA6ndpZlTxcVp7pWSCVZDMebBk2nqw.webp',
                'stock' => 20.0,
            ],

            // Lososi
            [
                'category' => 'lososi',
                'name' => 'Divlji losos',
                'price' => 2890,
                'description' => 'Divlji pacifički losos najvišeg kvaliteta',
                'file_path' => 'uploads/images/3OtQaO01H44Xotsw0uNyHSKEmk98bKFLECvxxWGN.jpg',
                'stock' => 5.0,
            ],

            // Školjke
            [
                'category' => 'školjke',
                'name' => 'Dagnje',
                'price' => 790,
                'description' => 'Sveže jadranske dagnje',
                'file_path' => 'uploads/images/ZJ8MILB6uVxi1KwmkmIGWUVyJQgIYSbqwUH6U4uW.jpg',
                'stock' => 12.0,
            ],
            [
                'category' => 'školjke',
                'name' => 'Kamenice',
                'price' => 1590,
                'description' => 'Kamenice premium klase',
                'file_path' => 'uploads/images/lbuGEcqamEz3WFmaijoT9vzr4XpkNtzF7A8TenfF.jpg',
                'stock' => 8.0,
            ],

            // Rakovi
            [
                'category' => 'rakovi',
                'name' => 'Gambori',
                'price' => 1990,
                'description' => 'Sveži tigrovi gamberi',
                'file_path' => 'uploads/images/LdeKFFfvdjW62oHLBVb1aJjvs7LPfCwK8jsRZuqZ.jpg',
                'stock' => 6.0,
            ],
            [
                'category' => 'rakovi',
                'name' => 'Jastog',
                'price' => 5990,
                'description' => 'Atlantski jastog vrhunskog kvaliteta',
                'file_path' => 'uploads/images/7dERO7E2HxZYodo6rO4KrO3FT99Vcp3glBFVXCtq.webp',
                'stock' => 3.5,
            ],
        ];

        foreach ($products as $product) {
            $categoryId = $categoryIds[$product['category']] ?? null;

            if (!$categoryId) {
                continue; // preskoči ako nema kategorije
            }

            DB::table('products')->insert([
                'product_categories_id' => $categoryId,
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'file_path' => $product['file_path'],
                'stock' => $product['stock'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
