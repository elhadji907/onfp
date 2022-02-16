<?php

namespace Database\Factories;

use App\Models\Individuelle;
use App\Models\Demandeur;
use App\Models\TypesDemande;
use App\Models\Commune;
use App\Models\Programme;
use App\Models\Diplome;
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
        $types_demande_id=TypesDemande::where('name', 'Individuelle')->first()->id;
        $communes_id=Commune::all()->random()->id;
        $diplomes_id=Diplome::all()->random()->id;
        $programmes_id=Programme::all()->random()->id;
            
        $nombre = rand(1, 9);
        $annee = date('y');
        
        return [
            'cin' => $cin,
            'nbre_pieces' => $nombre,
            'numero_dossier' => $this->faker->unique(true)->numberBetween(100, 999)."".$annee,
            'legende' => $this->faker->text,
            'reference' => $this->faker->text,
            'experience' => $this->faker->text,
            'date_depot' => $this->faker->dateTime(),
            'prerequis' => $this->faker->text,
            'information' => $this->faker->text,
            'items1' => $this->faker->word,
            'statut' => "Attente",
            'projetprofessionnel' => $this->faker->text,
            'note' => $this->faker->randomFloat(),
            'date1' => $this->faker->dateTime(),
            'qualification' => $this->faker->word,
            'etablissement' => $this->faker->word,
            'adresse' => $this->faker->word,
            'option' => $this->faker->word,
            'autres_diplomes' => $this->faker->word,
            'telephone' => $this->faker->e164PhoneNumber,
            'fixe' => $this->faker->phoneNumber,
            'motivation' => $this->faker->text,
            'optiondiplome' => $this->faker->word,
            'type' => $this->faker->randomElement($array = array('Nouvelle demande','Renouvellement')),

            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
            'diplomes_id' => function () use ($diplomes_id) {
                return $diplomes_id;
            },
            'programmes_id' => function () use ($programmes_id) {
                return $programmes_id;
            },
        ];
    }
}
