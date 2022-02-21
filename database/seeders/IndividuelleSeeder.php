<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Individuelle;
use App\Models\Projet;
use App\Models\Localite;
use App\Models\Zone;
use App\Models\Module;

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
            ->count(40)
            ->create();

        $projets = Projet::all();

        Individuelle::all()->each(function ($individuelle) use ($projets) {
            $individuelle->projets()->attach(
                $projets->random(rand(1, 4))->pluck('id')->toArray()
            );
        });

        $localites = Localite::all();

        Individuelle::all()->each(function ($individuelle) use ($localites) {
            $individuelle->localites()->attach(
                $localites->random(rand(1, 1))->pluck('id')->toArray()
            );
        });

        $zones = Zone::all();

        Individuelle::all()->each(function ($individuelle) use ($zones) {
            $individuelle->zones()->attach(
                $zones->random(rand(1, 1))->pluck('id')->toArray()
            );
        });

        $modules = Module::all();

        Individuelle::all()->each(function ($individuelle) use ($modules) {
            $individuelle->modules()->attach(
                $modules->random(rand(1, 1))->pluck('id')->toArray()
            );
        });
    }
}
