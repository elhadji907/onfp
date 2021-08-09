<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Helpers\SnNameGenerator as SnmG;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'civilite' => SnmG::getCivilite(),
            'firstname' => SnmG::getFirstName(),
            'name' => SnmG::getName(),
            'username' => Str::random(7),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->e164PhoneNumber,
            'fixe' => $this->faker->phoneNumber,
            'sexe' => SnmG::getSexe(),
            'date_naissance' => $this->faker->dateTime(),
            'lieu_naissance' => SnmG::getLieunaissance(),
            'situation_familiale' => SnmG::getFamiliale(),
            'adresse' => $this->faker->address,
            'bp' => $this->faker->postcode,
            'fax' => $this->faker->e164PhoneNumber,
            'email_verified_at' => now(),
            'password' => bcrypt($this->faker->password),
            'created_by' => SnmG::getFirstName().' '.SnmG::getFirstName().' ('.Str::random(7).')',
            'updated_by' => SnmG::getFirstName().' '.SnmG::getFirstName().' ('.Str::random(7).')',
            'deleted_by' => "",
            'roles_id' => "1",
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
