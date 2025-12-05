<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        $ContactMessage = [
            
         ['username' => 'Pera', 'message' =>' da li donosite ribu na kucnu adresu', 'comment' => 'Da Pero donosimo ribu na kucnu adresu'],

        ];
        foreach ($ContactMessage as $product) {
            DB::table('contact_message')->insert([

                'username' => $product['username'],
                'message' => $product['message'],
                'comment' => $product['comment'],
             

                
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
