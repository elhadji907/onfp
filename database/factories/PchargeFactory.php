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
        $nombre1 = rand(1, 2);
        $nombre2 = rand(100, 999);
        $nombre3 = rand(1965, 1998);
        $nombre4 = rand(1, 9);
        $nombre5 = rand(0, 9);
        $nombre6 = rand(0, 9);
        $nombre7 = rand(0, 9);
        $nombre8 = rand(0, 9);
        $nombre9 = rand(0, 9);
        $cin = $nombre1.$nombre2.$nombre3.$nombre4.$nombre5.$nombre6.$nombre7.$nombre8.$nombre9;
        $etablissements_id=Etablissement::all()->random()->id;
        $types_demande_id=TypesDemande::where('name', 'Prise en charge')->first()->id;

        return [
            'cin' => $cin,
            'annee' => $this->faker->numberBetween(2019, 2022),
            'matricule' => "PC".$this->faker->word,
            'items1' => $this->faker->word,
            'date1' => $this->faker->dateTime(),
            'date_depot' => $this->faker->dateTime(),
            'duree' => $this->faker->numberBetween(1, 3),
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
