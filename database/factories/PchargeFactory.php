<?php

namespace Database\Factories;

use App\Models\Pcharge;
use App\Models\Etablissement;
use App\Models\TypesDemande;
use App\Models\Demandeur;
use Illuminate\Database\Eloquent\Factories\Factory;

class PchargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pcharge::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $etablissements_id=Etablissement::all()->random()->id;
        $types_demande_id=TypesDemande::where('name', 'Prise en charge')->first()->id;

        return [
            'annee' => $this->faker->numberBetween(2019, 2022),
            'matricule' => "PC".$this->faker->word,
            'items1' => $this->faker->word,
            'date1' => $this->faker->dateTime(),
            'duree' => $this->faker->randomNumber(),
            'montant' => $this->faker->randomFloat(),
            'accompt' => $this->faker->randomFloat(),
            'reliquat' => $this->faker->randomFloat(),
            'statut' => "Attente",
            'file1' => "",
            'file2' => "",
            'file3' => "",
            'file4' => "",
            'file5' => "",
            'file6' => "",
            'file7' => "",
            'file8' => "",
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
        'etablissements_id' => function () use ($etablissements_id) {
            return $etablissements_id;
        },
        ];
    }
}
