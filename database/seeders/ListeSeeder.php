<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Liste;

class ListeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Liste::factory()
            ->count(30)
            ->create();
    }
}
