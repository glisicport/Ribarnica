<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ambijentSeeder extends Seeder
{
    public function run(): void
    {
        $ribe = [
            ['naziv'=>'Prodajni pult', 'slika'=>'prodajni_pult.jpg','opis'=>'Moderna rashladna vitrina sa svakodnevnom ponudom sveže ribe'] 
          
        ];
        foreach ($ribe as $product) {
            DB::table('ambijent')->insert([
                'naziv' => $product['naziv'],
                'slika' => $product['slika'],
                'opis' => $product['opis'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
