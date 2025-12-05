<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Pokreće proces seederovanja baze.
     */
    public function run(): void
    {
        // Primeri korisnika za testiranje sa role
        $usersToSeed = [
            [
                'name' => 'Luka Glisic',
                'email' => 'luka@gmail.com',
                // Lozinka: 'luka123123'
                'password' => Hash::make('123123'), 
                'role' => 'admin', // Luka je admin
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Test Korisnik',
                'email' => 'test@gmail.com',
                // Lozinka: 'password'
                'password' => Hash::make('123123'), 
                'role' => 'user', // običan korisnik
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Umetanje podataka u 'users' tabelu
        DB::table('users')->insert($usersToSeed);
    }
}
