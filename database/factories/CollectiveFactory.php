<?php

namespace Database\Factories;

use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;
use App\Models\Collective;
use App\Models\TypesDemande;
use App\Models\Demandeur;
use App\Models\Commune;
use App\Models\Projet;
use App\Models\Programme;
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
        $projet_id=Projet::all()->random()->id;
        $programmes_id=Programme::all()->random()->id;

        $nombre = rand(1, 9);
        
        return [
            'name' => SnmG::getEtablissement(),
            'date1' => $this->faker->dateTime(),
            'date_depot' => $this->faker->dateTime(),
            'sigle' => $this->faker->word,
            'statut' => "Attente",
            'description' => $this->faker->text,
            'adresse' => $this->faker->word,
            'telephone' => $this->faker->word,
            'fixe' => $this->faker->word,
            'bp' => $this->faker->word,
            'fax' => $this->faker->word,
            'projetprofessionnel' => $this->faker->text,
            'experience' => $this->faker->text,
            'prerequis' => $this->faker->text,
            'motivation' => $this->faker->text,
            'nbre_pieces' => $nombre,
            'type' => $this->faker->randomElement($array = array ('Nouvelle demande','Renouvellement')),
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
            'projets_id' => function () use ($projet_id) {
                return $projet_id;
            },
            'programmes_id' => function () use ($programmes_id) {
                return $programmes_id;
            },
        ];
    }
}
