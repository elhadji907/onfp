<?php

namespace Database\Factories;

use App\Models\Etablissement;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtablissementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etablissement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $communes_id=Commune::all()->random()->id;
        return [
            'matricule' => $faker->word,
            'name' => $faker->name,
            'sigle' => $faker->word,
            'items1' => $faker->word,
            'date1' => $faker->dateTime(),
            'telephone1' => $faker->word,
            'telephone2' => $faker->word,
            'fixe' => $faker->word,
            'email' => $faker->safeEmail,
            'adresse' => $faker->word,
            'communes_id' => function () {
                return factory(App\Commune::class)->create()->id;
            },
        ];
    }
}
