<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['name' => 'Svež losos', 'price' => 1890, 'category' => 'morsko', 'rating' => 4.8, 'description' => 'Norveški losos premium kvaliteta', 'icon' => 'fish', 'gradient' => 'from-blue-500 to-cyan-500'],
            ['name' => 'Sveža pastrmka', 'price' => 990, 'category' => 'slatkovodno', 'rating' => 4.6, 'description' => 'Lokalna slatkovodna pastrmka', 'icon' => 'fish', 'gradient' => 'from-green-500 to-emerald-500'],
            ['name' => 'Brancin', 'price' => 1450, 'category' => 'morsko', 'rating' => 4.7, 'description' => 'Mediteranski brancin svež', 'icon' => 'fish', 'gradient' => 'from-purple-500 to-pink-500', 'badge' => 'AKCIJA'],
            ['name' => 'Škampi', 'price' => 2890, 'category' => 'skoljke', 'rating' => 4.9, 'description' => 'Sveži jadranski škampi', 'icon' => 'shrimp', 'gradient' => 'from-orange-500 to-red-500'],
            ['name' => 'Tuna', 'price' => 2200, 'category' => 'morsko', 'rating' => 4.8, 'description' => 'Sveža tuna vrhunskog kvaliteta', 'icon' => 'fish', 'gradient' => 'from-red-500 to-pink-500'],
            ['name' => 'Šaran', 'price' => 650, 'category' => 'slatkovodno', 'rating' => 4.5, 'description' => 'Domaći šaran iz uzgoja', 'icon' => 'fish', 'gradient' => 'from-yellow-500 to-orange-500'],
            ['name' => 'Lignje', 'price' => 1550, 'category' => 'skoljke', 'rating' => 4.6, 'description' => 'Sveže lignje sa Jadrana', 'icon' => 'fish', 'gradient' => 'from-indigo-500 to-purple-500'],
            ['name' => 'Skuša', 'price' => 890, 'category' => 'morsko', 'rating' => 4.4, 'description' => 'Sveža skuša bogata omega-3', 'icon' => 'fish', 'gradient' => 'from-blue-600 to-blue-800'],
            ['name' => 'Som', 'price' => 1100, 'category' => 'slatkovodno', 'rating' => 4.7, 'description' => 'Veliki som iz čistih voda', 'icon' => 'fish', 'gradient' => 'from-gray-600 to-gray-800'],
            ['name' => 'Dagnje', 'price' => 450, 'category' => 'skoljke', 'rating' => 4.5, 'description' => 'Sveže crnogorske dagnje', 'icon' => 'shrimp', 'gradient' => 'from-purple-600 to-pink-600'],
            ['name' => 'Dimljeni losos', 'price' => 2400, 'category' => 'dimljeno', 'rating' => 4.9, 'description' => 'Dimljeni norveški losos', 'icon' => 'fish', 'gradient' => 'from-orange-600 to-red-600'],
            ['name' => 'Dimljena pastrmka', 'price' => 1200, 'category' => 'dimljeno', 'rating' => 4.7, 'description' => 'Dimljena pastrmka tradicionalno', 'icon' => 'fish', 'gradient' => 'from-amber-600 to-orange-700'],
            ['name' => 'Orada', 'price' => 1650, 'category' => 'morsko', 'rating' => 4.8, 'description' => 'Mediteranska orada premium', 'icon' => 'fish', 'gradient' => 'from-cyan-500 to-blue-600'],
            ['name' => 'Kamenice', 'price' => 3500, 'category' => 'skoljke', 'rating' => 5.0, 'description' => 'Francuske kamenice delikatesa', 'icon' => 'shrimp', 'gradient' => 'from-emerald-600 to-teal-700'],
            ['name' => 'Oslić', 'price' => 1350, 'category' => 'morsko', 'rating' => 4.6, 'description' => 'Sveži oslić sa Jadrana', 'icon' => 'fish', 'gradient' => 'from-blue-400 to-cyan-500'],
            ['name' => 'Dimljeni som', 'price' => 1450, 'category' => 'dimljeno', 'rating' => 4.8, 'description' => 'Domaći dimljeni som', 'icon' => 'fish', 'gradient' => 'from-stone-600 to-gray-700'],
        ];
        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'price' => $product['price'],
                'category' => $product['category'],
                'rating' => $product['rating'],
                'description' => $product['description'] ?? null,
                'icon' => $product['icon'] ?? null,
                'gradient' => $product['gradient'] ?? null,
                'badge' => $product['badge'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
