<?php

namespace Database\Factories;

use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;
use App\Models\Collective;
use App\Models\TypesDemande;
use App\Models\Demandeur;
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
        return [
            'cin' => $cin,
            'name' => SnmG::getEtablissement(),
            'date1' => $this->faker->dateTime(),
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
            'sigle' => $this->faker->word,
            'statut' => SnmG::getStatut(),
            'description' => $this->faker->text,
        ];
    }
}
