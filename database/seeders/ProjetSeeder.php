<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('projets')->insert([
             "name"=>"Projet d'employabilite des jeunes par l'apprentissage",
             "sigle"=>"PEJA",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);
         DB::table('projets')->insert([
             "name"=>"Projet d’appui au Développement des Compétences et de l’Entreprenariat des Jeunes dans les secteurs porteurs",
             "sigle"=>"PDCEJ",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);
         DB::table('projets')->insert([
             "name"=>"Accès équitable à la formation professionnelle",
             "sigle"=>"ACEFOP",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);
    }
}
