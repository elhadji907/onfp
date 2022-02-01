<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocaliteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('localites')->insert([
               "nom" => "Ziguinchor",
               "projets_id" =>"4",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
                ]);

        DB::table('localites')->insert([
               "nom" => "Bignona",
               "projets_id" =>"4",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
                ]);
   
        DB::table('localites')->insert([
               "nom" => "Bounkiling",
               "projets_id" =>"4",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
                ]);

    }
}
