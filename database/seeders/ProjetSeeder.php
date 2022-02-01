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
             "ingenieurs_id"=>"1",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);

         DB::table('projets')->insert([
             "name"=>"Projet d’appui au Développement des Compétences et de l’Entreprenariat des Jeunes dans les secteurs porteurs",
             "sigle"=>"PDCEJ",
             "ingenieurs_id"=>"2",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);

         DB::table('projets')->insert([
             "name"=>"Accès équitable à la formation professionnelle",
             "sigle"=>"ACEFOP",
             "ingenieurs_id"=>"3",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);

         DB::table('projets')->insert([
             "name"=>"PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD",
             "sigle"=>"SZM",
             "ingenieurs_id"=>"1",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);


    }
}
