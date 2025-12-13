<?php

namespace Database\Seeders;   // OVO je bitno!

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('faqs')->insert([
            [
                'question'   => 'Gde se nalazi TFZR Ribarnica?',
                'answer'     => 'TFZR Ribarnica se nalazi u sklopu Tehničkog fakulteta u Zrenjaninu, u prizemlju glavne zgrade, pored studentske menze.',
                'is_active'  => true,
                'order'      => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question'   => 'Koje vrste ribe najčešće imate u ponudi?',
                'answer'     => 'Najčešće su u ponudi losos, pastrmka, šaran, smuđ i oslić, a ponuda zavisi od dnevnih isporuka.',
                'is_active'  => true,
                'order'      => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question'   => 'Da li radite porudžbine za veće događaje?',
                'answer'     => 'Da, TFZR Ribarnica prima porudžbine za ugostitelje, proslave i veće događaje uz prethodnu najavu od najmanje 48h.',
                'is_active'  => true,
                'order'      => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
