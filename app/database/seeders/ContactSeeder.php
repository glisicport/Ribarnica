<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $contacts = [
            [
                'name'    => 'TFZR RIBARNICA',
                'email'   => 'TFZRRIBARNICA@gmail.com',
                'phone'   => '+381 61 2345678',
                'message' => 'Dobrodosli u nasu ribarnicu',
            ],
        ];

        foreach ($contacts as $contact) {
            DB::table('contact')->insert([
                'name'       => $contact['name'],
                'email'      => $contact['email'],
                'phone'      => $contact['phone'],
                'message'    => $contact['message'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
