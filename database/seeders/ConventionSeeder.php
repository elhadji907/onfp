<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('conventions')->insert([
            "numero"=>"NUM1",
            "name"=>"Convention 1",
            "sigle"=>"Conv 1",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
       ]);

        DB::table('conventions')->insert([
            "numero"=>"NUM2",
            "name"=>"Convention 2",
            "sigle"=>"Conv 2",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
       ]);

    }
}
