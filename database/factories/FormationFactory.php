<?php

namespace Database\Factories;

use App\Models\Formation;
use App\Models\TypesFormation;
use App\Models\Commune;
use App\Models\Ingenieur;
use App\Models\Individuelle;
use Illuminate\Database\Eloquent\Factories\Factory;

class FormationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Formation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $annee = date('y');
    
        $types_formations_id=TypesFormation::all()->random()->id;
        $communes_id=Commune::all()->random()->id;
        $ingenieurs_id=Ingenieur::all()->random()->id;
        $ingenieurs_id=Individuelle::all()->random()->id;
    
        $prevue_h = $this->faker->numberBetween(5, 9);
        $prevue_f = $this->faker->numberBetween(5, 1);
    
        $effectif_total = $prevue_h + $prevue_f;
    
        $forme_h = $this->faker->numberBetween(5, 9);
        $forme_f = $this->faker->numberBetween(5, 9);
    
        $total = $forme_h + $forme_f;

        return [
            'code' => 'FP'."".$annee.$this->faker->unique(true)->numberBetween(0, 300),
            'name' => $this->faker->company,
            'qualifications' => $this->faker->word,
            'effectif_total' => $effectif_total,
            'date_pv' => $this->faker->dateTime(),
            'date_debut' => $this->faker->dateTimeBetween('-3 week', '+1 week'),
            'date_fin' => $this->faker->dateTimeBetween('-1 week', '+5 week'),
            'adresse' => $this->faker->address,
            'prevue_h' => $prevue_h,
            'prevue_f' => $prevue_f,
            'titre' => $this->faker->word,
            'attestation' => $this->faker->word,
            'forme_h' => $forme_h,
            'forme_f' => $forme_f,
            'total' => $total,
            'lieu' => $this->faker->word,
            'convention_col' => $this->faker->word,
            'decret' => $this->faker->word,
            'beneficiaires' => $this->faker->company,
            'ingenieurs_id' => function () use ($ingenieurs_id) {
                return $ingenieurs_id;
            },
            'types_formations_id' => function () use ($types_formations_id) {
                return $types_formations_id;
            },
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
        ];
        
    }
}
