<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operateur;

class OperateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operateur::factory()
            ->count(15)
            ->create();
    }
}
