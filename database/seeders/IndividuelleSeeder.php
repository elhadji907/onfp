<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Individuelle;
use App\Models\Projet;
use App\Models\Localite;
use App\Models\Zone;
use App\Models\Module;
use App\Models\Formation;

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
            ->count(1500)
            ->create();

        $projets = Projet::all();
        Individuelle::all()->each(function ($individuelle) use ($projets) {
            $individuelle->projets()->attach(
                $projets->random(rand(1, 2))->pluck('id')->toArray()
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
                $modules->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $formations = Formation::all();
        Individuelle::all()->each(function ($individuelle) use ($formations) {
            $individuelle->formations()->attach(
                $formations->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
