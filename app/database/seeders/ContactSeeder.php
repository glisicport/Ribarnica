<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contact = [
       ['name' => 'TFZR RIBARNICA', 'email' =>' TFZRRIBARNICA@gmail.com', 'phone' => '+381 61 2345678', 'message' => 'Dobrodosli u nasu ribarnicu'],
        ];
        foreach ($contact as $product) {
            DB::table('products')->insert([
                'name' => $product['name'],
                'email' => $product['email'],
                'phone' => $product['phone'],
                'message' => $product['message'],
                
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
