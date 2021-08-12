<?php

namespace Database\Factories;

use App\Models\Lieux;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\Factory;

class LieuxFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lieux::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $commune=Commune::all()->random()->nom;

        return [
            'name' => $commune,
        ];
    }
}
