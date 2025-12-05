<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class gallerySeeder extends Seeder
{
    public function run(): void
    {
        $gallery = [
            ['naziv_slike'=>'losos.jpg', 'opis'=>'Svež losos iz Norveške','putanja'=>'images/ribe/losos.jpg','datum_postavljanja'=>now(),'created_at'=>now(),'updated_at'=>now()] 
          
        ];
        foreach ($gallery as $product) {
            DB::table('galerija')->insert([
                'naziv_slike' => $product['naziv_slike'],
                'opis' => $product['opis'],
                'putanja' => $product['putanja'],
                'datum_postavljanja' => $product['datum_postavljanja'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
