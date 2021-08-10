<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            "name"=>"Arabe",
            "uuid"=>Str::uuid(),
        ]);
        DB::table('options')->insert([
            "name"=>"Lettre moderne",
            "uuid"=>Str::uuid(),
        ]);
        DB::table('options')->insert([
            "name"=>"Lettre classique",
            "uuid"=>Str::uuid(),
        ]);
        DB::table('options')->insert([
            "name"=>"Science",
            "uuid"=>Str::uuid(),
        ]);
        DB::table('options')->insert([
            "name"=>"Technique",
            "uuid"=>Str::uuid(),
        ]);
    }
}
