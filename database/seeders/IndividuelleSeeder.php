<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Individuelle;
use App\Models\Projet;

class IndividuelleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Individuelle::factory()
            ->count(150)
            ->create();

        $projets = Projet::all();

        Individuelle::all()->each(function ($individuelle) use ($projets) {
            $individuelle->projets()->attach(
                $projets->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
    }
}
