<?php

namespace Database\Factories;

use App\Models\Operateur;
use App\Models\Commune;
use App\Models\Ninea;
use App\Models\User;
use App\Models\Role;
use App\Models\TypesOperateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SnNameGenerator as SnmG;

class OperateurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operateur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $communes_id=Commune::all()->random()->id;
        $nineas_id=Ninea::all()->random()->id;
        $types_operateurs_id=TypesOperateur::all()->random()->id;
        $role_id=Role::where('name', 'Operateur')->first()->id;
        $annee = date('Y');

        return [
            'numero_agrement' => $this->faker->unique(true)->numberBetween(1000, 9999).'/ONFP/DG/DEC/'.$annee,
            'name' => $this->faker->name,
            'sigle' => "",
            'typestructure' => SnmG::getTypesstructure(),
            'ninea' => $this->faker->word,
            'rccm' => $this->faker->word,
            'quitus' => $this->faker->word,
            'telephone1' => $this->faker->word,
            'telephone2' => $this->faker->word,
            'fixe' => $this->faker->word,
            'email1' => $this->faker->word,
            'email2' => $this->faker->word,
            'adresse' => $this->faker->word,
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'users_id' => function () use ($role_id) {
                return User::factory()->create(["roles_id"=>$role_id])->id;
            },
            /* 'rccms_id' => function () {
                return factory(App\Rccm::class)->create()->id;
            }, */
            'nineas_id' => function () use ($nineas_id) {
                return $nineas_id;
            },
            
            'types_operateurs_id' => function () use ($types_operateurs_id) {
                return $types_operateurs_id;
            },

         /*    'specialites_id' => function () {
                return factory(App\Specialite::class)->create()->id;
            }, */

           /*  'courriers_id' => function () {
                return factory(App\Courrier::class)->create()->id;
            }, */
        ];
    }
}
