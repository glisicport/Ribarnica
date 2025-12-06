<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $this->call([
          UserSeeder::class,
        ProductCategorySeeder::class,
    ]);
        
        $this->call(ProductSeeder::class);
        $this->call(ambijentSeeder::class);
        $this->call(gallerySeeder::class);
        
    
        $this->call(EmployeeSeeder::class);
        $this->call(about_usSeeder::class);
    }
}
