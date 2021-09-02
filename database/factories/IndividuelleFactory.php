<?php

namespace Database\Factories;

use App\Models\Individuelle;
use App\Models\Demandeur;
use App\Models\TypesDemande;
use App\Models\Commune;
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
            
        $nombre = rand(1, 9);
        
        return [
            'cin' => $cin,
            'nbre_pieces' => $nombre,
            'legende' => $this->faker->text,
            'reference' => $this->faker->text,
            'experience' => $this->faker->text,
            'projet' => $this->faker->text,
            'date_depot' => $this->faker->dateTime(),
            'prerequis' => $this->faker->text,
            'information' => $this->faker->text,
            'items1' => $this->faker->word,
            'statut' => "Attente",
            'date1' => $this->faker->dateTime(),
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
        ];
    }
}
