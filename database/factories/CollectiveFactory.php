<?php

namespace Database\Factories;

use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;
use App\Models\Collective;
use App\Models\TypesDemande;
use App\Models\Demandeur;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Collective::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_demande_id=TypesDemande::where('name', 'Collective')->first()->id;
        $communes_id=Commune::all()->random()->id;
        
        return [
            'name' => SnmG::getEtablissement(),
            'date1' => $this->faker->dateTime(),
            'date_depot' => $this->faker->dateTime(),
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
            'sigle' => $this->faker->word,
            'statut' => "Attente",
            'description' => $this->faker->text,
        ];
    }
}
