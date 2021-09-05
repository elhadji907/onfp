<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScolariteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scolarites')->insert([
            'annee' => "2021-2022",
            'statut' => "Fermé",
            'date_debut' => "2021-05-04",
            'date_fin' => "2021-06-04",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('scolarites')->insert([
            'annee' => "2022-2023",
            'statut' => "Fermé",
            'date_debut' => "2022-05-04",
            'date_fin' => "2022-06-04",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
