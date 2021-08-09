<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Helpers\SnNameGenerator as SnmG;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,15) as $value) {
            DB::table('users')->insert(
                [
                    'uuid' => Str::uuid(),
                    'civilite' => SnmG::getCivilite(),
                    'firstname' => SnmG::getFirstName(),
                    'name' => SnmG::getName(),
                    'username' => Str::random(7),
                    'email' => $faker->unique()->safeEmail(),
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
                    'roles_id' => "1",
                ]
            );
        }
    }
}
