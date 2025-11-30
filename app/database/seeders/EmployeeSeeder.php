<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employees = [
    [
        'name' => 'Marko',
        'last_name' => 'Petrović',
        'position' => 'Ribar',
        'bio' => 'Više od 15 godina iskustva u profesionalnom ribolovu i obradi sveže ribe.',
        'photo' => 'marko.jpg',
    ],
    [
        'name' => 'Ivana',
        'last_name' => 'Janković',
        'position' => 'Menadžer prodaje',
        'bio' => 'Zadužena za koordinaciju prodaje i rad sa dobavljačima.',
        'photo' => 'ivana.jpg',
    ],
    [
        'name' => 'Stefan',
        'last_name' => 'Lukić',
        'position' => 'Radnik u magacinu',
        'bio' => 'Odgovoran za skladištenje i pripremu proizvoda za prodaju.',
        'photo' => 'stefan.jpg',
    ],
    [
        'name' => 'Milica',
        'last_name' => 'Đorđević',
        'position' => 'Kasir',
        'bio' => 'Uvek nasmejana, vodi računa o naplati i komunikaciji sa kupcima.',
        'photo' => 'milica.jpg',
    ],
    [
        'name' => 'Aleksandar',
        'last_name' => 'Milenković',
        'position' => 'Filetir',
        'bio' => 'Specijalista za filetiranje i pripremu sveže ribe.',
        'photo' => 'aleksandar.jpg',
    ],
    [
        'name' => 'Jovana',
        'last_name' => 'Pavlović',
        'position' => 'Marketing menadžer',
        'bio' => 'Brine o brendu TFZR Ribarnica i promociji proizvoda.',
        'photo' => 'jovana.jpg',
    ],
    [
        'name' => 'Nikola',
        'last_name' => 'Jović',
        'position' => 'Vozač – dostavljač',
        'bio' => 'Zadužen za blagovremenu i bezbednu dostavu narudžbina.',
        'photo' => 'nikola.jpg',
    ],
    [
        'name' => 'Sara',
        'last_name' => 'Stojanović',
        'position' => 'Kontrolor kvaliteta',
        'bio' => 'Vodi računa o kvalitetu i svežini svih proizvoda.',
        'photo' => 'sara.jpg',
    ],
    [
        'name' => 'Miloš',
        'last_name' => 'Ilić',
        'position' => 'Pomoćni radnik',
        'bio' => 'Pomaže u pripremi proizvoda i održavanju higijene.',
        'photo' => 'milos.jpg',
    ],
];

        foreach ($employees as $product) {
            DB::table('employees')->insert([
                'name' => $product['name'],
                'last_name' => $product['last_name'],
                'position' => $product['position'],
                'bio' => $product['bio'],
                'photo' => $product['photo'] ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
