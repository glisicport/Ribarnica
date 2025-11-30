<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'morsko',
            'bela riba',
            'plava riba',
            'lososi',
            'školjke',
            'rakovi',
        ];

        foreach ($categories as $categoryName) {
            DB::table('product_categories')->updateOrInsert(
                ['name' => $categoryName],
                [
                    'name' => $categoryName,
                    'slug' => Str::slug($categoryName),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
