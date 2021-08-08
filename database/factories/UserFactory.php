<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        return [

            /* 'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10), */

            'civilite' => SnmG::getCivilite(),
            'firstname' => SnmG::getFirstName(),
            'name' => SnmG::getName(),
            'username' => Str::random(7),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $faker->e164PhoneNumber,
            'fixe' => $faker->phoneNumber,
            'sexe' => SnmG::getSexe(),
            'date_naissance' => $faker->dateTime(),
            'lieu_naissance' => SnmG::getLieunaissance(),
            'situation_familiale' => SnmG::getFamiliale(),
            'adresse' => $faker->address,
            'bp' => $faker->postcode,
            'fax' => $faker->e164PhoneNumber,
            'email_verified_at' => $faker->dateTimeBetween(),
            'password' => bcrypt($faker->password),
            'created_by' => SnmG::getFirstName().' '.SnmG::getFirstName().' ('.Str::random(7).')',
            'updated_by' => SnmG::getFirstName().' '.SnmG::getFirstName().' ('.Str::random(7).')',
            'deleted_by' => "",
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
