<?php

namespace Database\Factories;

use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;
use App\Models\Demandeur;
use App\Models\User;
use App\Models\TypesDemande;
use App\Models\Domaine;
use App\Models\Courrier;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Demandeur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /* $role_id=Role::where('name', 'Demandeur')->first()->id; */
        $types_demandes_id  =   TypesDemande::all()->random()->id;
        $courriers_id       =   Courrier::all()->random()->id;
        $domaine            =   Domaine::all()->random()->name;
        
        $nombre = rand(1, 9);
        $annee = date('y');

        return [
            'numero' => $this->faker->unique(true)->numberBetween(100, 999)."".$annee,
            'date1' => $this->faker->dateTime(),         
            'users_id' => function () {
                return User::factory()->create()->id;
            },
            /* 'users_id' => function () use ($role_id) {
                return User::factory()->create(["roles_id"=>$role_id])->id;
            }, */
        /* 'items_id' => function () {
            return factory(App\Item::class)->create()->id;
        }, */
            'types_demandes_id' => function () use ($types_demandes_id) {
                return $types_demandes_id;
            },
            'courriers_id' =>function () use ($courriers_id) {
                return $courriers_id;
            },
        ];
    }
}
