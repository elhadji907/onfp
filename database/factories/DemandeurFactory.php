<?php

namespace Database\Factories;

use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;
use App\Models\Demandeur;
use App\Models\Role;
use App\Models\User;
use App\Models\Projet;
use App\Models\Programme;
use App\Models\Region;
use App\Models\Commune;
use App\Models\Lieux;
use App\Models\Diplome;
use App\Models\TypesDemande;
use App\Models\Domaine;
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
        $annee = date('y');
        $role_id=Role::where('name', 'Demandeur')->first()->id;
        $projet_id=Projet::all()->random()->id;
        $programmes_id=Programme::all()->random()->id;
        $regions_id=Region::all()->random()->id;
        $communes_id=Commune::all()->random()->id;
        $lieux_id=Lieux::all()->random()->id;
        $diplomes_id=Diplome::all()->random()->id;
        $types_demandes_id=TypesDemande::all()->random()->id;
        $domaine=Domaine::all()->random()->name;
        
        $nombre = rand(1, 9);

        return [
            'numero' => $this->faker->unique(true)->numberBetween(100, 999)."".$annee,
            'etablissement' => SnmG::getEtablissement(),
            'niveau_etude' => SnmG::getNiveaux(),
            'qualification' => $this->faker->text,
            'experience' => $this->faker->text,
            'deja_forme' => SnmG::getDeja(),
            'adresse' => $this->faker->address,
            'option' => $domaine,
            'autres_diplomes' => SnmG::getDiplome(),
            'telephone' => $this->faker->e164PhoneNumber,
            'fixe' => $this->faker->phoneNumber,
            'statut' => "Attente",
            'motivation' => $this->faker->paragraph(3),
            'nbre_piece' => $nombre,
            'date_depot' => $this->faker->dateTime(),
            'date1' => $this->faker->dateTime(),
            'date2' => $this->faker->dateTime(),
            'users_id' => function () use ($role_id) {
                return User::factory()->create(["roles_id"=>$role_id])->id;
            },
            'lieux_id' => function () use ($lieux_id) {
                return $lieux_id;
            },
            'projets_id' => function () use ($projet_id) {
                return $projet_id;
            },
            'programmes_id' => function () use ($programmes_id) {
                return $programmes_id;
            },
            'regions_id' => function () use ($regions_id) {
                return $regions_id;
            },
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'diplomes_id' => function () use ($diplomes_id) {
                return $diplomes_id;
            },
            'types_demandes_id' => function () use ($types_demandes_id) {
                return $types_demandes_id;
            },
        ];
    }
}
