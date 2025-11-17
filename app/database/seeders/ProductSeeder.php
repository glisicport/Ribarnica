<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Svež losos',
                'price' => 1890,
                'category' => 'morsko',
                'description' => 'Norveški losos premium kvaliteta',
                'file_path' => '/uploads/images/riba1.png'
            ],
        ];

        foreach ($products as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'price' => $product['price'],
                'category' => $product['category'],
                'description' => $product['description'] ?? null,
                'file_path' => $product['file_path'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
