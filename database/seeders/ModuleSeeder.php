<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('modules')->insert([
            "name"=>"Accueil",
            "domaines_id"=>"1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
          DB::table('modules')->insert([
            "name"=>"Assistanat de direction",
            "domaines_id"=>"1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
          DB::table('modules')->insert([
            "name"=>"Gestion administrative",
            "domaines_id"=>"1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
          DB::table('modules')->insert([
            "name"=>"Secrétariat",
            "domaines_id"=>"1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]); 
          DB::table('modules')->insert([
            "name"=>"Laveur",
            "domaines_id"=>"34",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
          DB::table('modules')->insert([
            "name"=>"Graisseur",
            "domaines_id"=>"34",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
          DB::table('modules')->insert([
            "name"=>"Pompiste",
            "domaines_id"=>"33",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
          DB::table('modules')->insert([
            "name"=>"Rayonniste",
            "domaines_id"=>"9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
          DB::table('modules')->insert([
            "name"=>"Caissier",
            "domaines_id"=>"9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
           DB::table('modules')->insert([
            "name"=>"Chef de boutique",
            "domaines_id"=>"9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
           DB::table('modules')->insert([
            "name"=>"Manager de station",
            "domaines_id"=>"9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
    }
}
