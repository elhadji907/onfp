<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FamilialeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
         
        DB::table('familiales')->insert([
            'name' => "Primaire",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
         
        DB::table('familiales')->insert([
            'name' => "Collège",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
         
        DB::table('familiales')->insert([
            'name' => "Secondaire",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
         
        DB::table('familiales')->insert([
            'name' => "Supérieur",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
    }
}
