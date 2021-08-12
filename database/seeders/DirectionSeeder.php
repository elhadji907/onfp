<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directions')->insert([
            'name' => "Directeur Général",
            "sigle"=> "DG",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Direction de l'Evaluation et de la Certification",
            "sigle"=> "DEC",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Direction de la planification des projets",
            "sigle"=> "DPP",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Direction Administrative et Financière",
            "sigle"=> "DAF",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Direction de l'Ingénierie et de la Formation",
            "sigle"=> "DIOF",
            'types_directions_id'=> '3',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
