<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            ContactSeeder::class,
            ContactMessageSeeder::class,
            ambijentSeeder::class,
            gallerySeeder::class,
            EmployeeSeeder::class,
            about_usSeeder::class,
        ]);
    }
}
