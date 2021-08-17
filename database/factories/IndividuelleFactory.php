<?php

namespace Database\Factories;

use App\Models\Individuelle;
use App\Models\Demandeur;
use App\Models\TypesDemande;
use Illuminate\Database\Eloquent\Factories\Factory;

class IndividuelleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Individuelle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_demande_id=TypesDemande::where('name', 'Individuelle')->first()->id;
            
        $nombre = rand(1, 9);
        return [
            'nbre_pieces' => $nombre,
            'legende' => $this->faker->text,
            'reference' => $this->faker->text,
            'experience' => $this->faker->text,
            'projet' => $this->faker->text,
            'prerequis' => $this->faker->text,
            'information' => $this->faker->text,
            'items1' => $this->faker->word,
            'date1' => $this->faker->dateTime(),
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
        ];
    }
}
