<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Role;
use App\Models\Administrateur;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Helpers\SnNameGenerator as SnmG;

class AdministrateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Administrateur::factory()
            ->count(30)
            ->create();
    }
}
