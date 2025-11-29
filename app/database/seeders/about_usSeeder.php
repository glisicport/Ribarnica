<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class about_usSeeder extends Seeder
{
    public function run(): void
    {
        $about_us = [
    [
        'title' => 'Dobrodošli u TFZR Ribarnicu',
        'short_description' => 'Sveža riba, kvalitet i tradicija',
        'long_description' => 'TFZR Ribarnica je mesto gde se spajaju tradicija, znanje i vrhunska svežina. 
        Naš tim sa dugogodišnjim iskustvom svakodnevno bira najkvalitetniju ponudu iz domaćih i stranih izvora. 
        Posvećeni smo tome da pružimo proizvode koji zadovoljavaju najviše standarde – od ulova do vaše trpeze.',
        'image' => 'ribarnica1.jpg',
        'mission' => 'Naša misija je da obezbedimo najkvalitetniju i najsvežiju ribu uz profesionalnu uslugu i potpunu transparentnost.',
        'vision' => 'Naša vizija je da postanemo vodeća ribarnica u regionu koja je sinonim za kvalitet, poverenje i savremenu uslugu.'
    ],
];

        foreach ($about_us as $product) {
            DB::table('about_us')->insert([
                'title' => $product['title'],
                'short_description' => $product['short_description'],
                'long_description' => $product['long_description'],
                'image' => $product['image'],
                'mission' => $product['mission'],
                'vision' => $product['vision'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
