<?php

namespace Database\Factories;

use App\Models\Etat;
use App\Models\TypesCourrier;
use App\Models\Courrier;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_courrier_id=TypesCourrier::where('name','Etats')->first()->id;
        $annee = date('y');

        return [
            'numero' => 'CD'.$this->faker->numberBetween(0, 100)."".$annee,
            'date_recep' => $this->faker->dateTime(),
            'designation' => $this->faker->text,
            'observation' => $this->faker->text,
            'montant' => $this->faker->randomFloat(),
            'date_depart' => $this->faker->dateTime(),
            'date_retour' => $this->faker->dateTime(),
            'date_transmission' => $this->faker->dateTime(),
            'date_dg' => $this->faker->dateTime(),
            'date_ac' => $this->faker->dateTime(),
            'courriers_id' => function () use($types_courrier_id) {
                return Courrier::factory()->create(["types_courriers_id"=>$types_courrier_id])->id;
            },
        ];
    }
}
