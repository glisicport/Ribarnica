<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categoryIds = DB::table('product_categories')
            ->pluck('id', 'name');

        $products = [
            // Morsko
            [
                'category' => 'morsko',
                'name' => 'Svež losos',
                'price' => 1890,
                'description' => 'Norveški losos premium kvaliteta',
                'file_path' => '/uploads/images/riba_losos.png'
            ],
            [
                'category' => 'morsko',
                'name' => 'Tuna steak',
                'price' => 2490,
                'description' => 'Svež žutoperajni tuna steak',
                'file_path' => '/uploads/images/riba_tuna.png'
            ],

            // Bela riba
            [
                'category' => 'bela riba',
                'name' => 'Oslić',
                'price' => 890,
                'description' => 'Bela riba blagog ukusa, idealna za pečenje',
                'file_path' => '/uploads/images/riba_oslic.png'
            ],
            [
                'category' => 'bela riba',
                'name' => 'Som',
                'price' => 1490,
                'description' => 'Svež rečni som vrhunskog kvaliteta',
                'file_path' => '/uploads/images/riba_som.png'
            ],

            // Plava riba
            [
                'category' => 'plava riba',
                'name' => 'Skuša',
                'price' => 690,
                'description' => 'Masna riba intenzivnog ukusa',
                'file_path' => '/uploads/images/riba_skusa.png'
            ],
            [
                'category' => 'plava riba',
                'name' => 'Sardina',
                'price' => 490,
                'description' => 'Jadranska sardina, dnevno ulovljena',
                'file_path' => '/uploads/images/riba_sardina.png'
            ],

            // Lososi
            [
                'category' => 'lososi',
                'name' => 'Divlji losos',
                'price' => 2890,
                'description' => 'Divlji pacifički losos najvišeg kvaliteta',
                'file_path' => '/uploads/images/riba_divlji_losos.png'
            ],

            // Školjke
            [
                'category' => 'školjke',
                'name' => 'Dagnje',
                'price' => 790,
                'description' => 'Sveže jadranske dagnje',
                'file_path' => '/uploads/images/riba_dagnje.png'
            ],
            [
                'category' => 'školjke',
                'name' => 'Kamenice',
                'price' => 1590,
                'description' => 'Kamenice premium klase',
                'file_path' => '/uploads/images/riba_kamenice.png'
            ],

            // Rakovi
            [
                'category' => 'rakovi',
                'name' => 'Gambori',
                'price' => 1990,
                'description' => 'Sveži tigrovi gamberi',
                'file_path' => '/uploads/images/riba_gamberi.png'
            ],
            [
                'category' => 'rakovi',
                'name' => 'Jastog',
                'price' => 5990,
                'description' => 'Atlantski jastog vrhunskog kvaliteta',
                'file_path' => '/uploads/images/riba_jastog.png'
            ],
        ];

        foreach ($products as $product) {
            $categoryId = $categoryIds[$product['category']] ?? null;

            if (!$categoryId) {
                continue;
            }

            DB::table('products')->insert([
                'product_categories_id' => $categoryId,
                'name' => $product['name'],
                'price' => $product['price'],
                'description' => $product['description'],
                'file_path' => $product['file_path'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
