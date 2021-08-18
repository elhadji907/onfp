<?php

namespace Database\Factories;

use App\Models\Findividuelle;
use App\Models\TypesFormation;
use App\Models\Formation;
use Illuminate\Database\Eloquent\Factories\Factory;

class FindividuelleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Findividuelle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $annee = date('y');
        
        $types_formation_id=TypesFormation::where('name', 'Individuelle')->first()->id;
    
        return [
            'code' => 'I'."".$annee.$this->faker->unique(true)->numberBetween(0, 300),
            'categorie' => $this->faker->word,
            'formations_id' => function () use ($types_formation_id) {
                return Formation::factory()->create(["types_formations_id"=>$types_formation_id])->id;
            },
        ];
    }
}