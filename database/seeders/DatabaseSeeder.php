<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* \App\Models\User::factory(10)->create(); */

        $this->call([
            /* RoleSeeder::class, */
            PermissionsOnfpSeeder::class,
            FamilialeSeeder::class,
            ProfessionnelleSeeder::class,
            ConventionSeeder::class,
            AdministrateurSeeder::class,
            GestionnaireSeeder::class,
            TypeCourrierSeeder::class,
            NiveauSeeder::class,
            DiplomeSeeder::class,
            ActiviteSeeder::class,
            ProjetSeeder::class,
            InterneSeeder::class,
            DepartSeeder::class,
            RecueSeeder::class,
            ProgrammeSeeder::class,
            RegionSeeder::class,
            DepartementSeeder::class,
            ArrondissementSeeder::class,
            CommuneSeeder::class,
            ListeSeeder::class,
            BordereauSeeder::class,
            FacturedafSeeder::class,
            TresorSeeder::class,
            BanqueSeeder::class,
            MissionSeeder::class,
            EtatSeeder::class,
            EtatpreviSeeder::class,
            FadSeeder::class,
            ImputationSeeder::class,
            FonctionSeeder::class,
            CategorieSeeder::class,
            EmployeeSeeder::class,
            TypesDirectionSeeder::class,
            DirectionSeeder::class,
            AntenneSeeder::class,
            DepenseSeeder::class,
            SecteurSeeder::class,
            DomaineSeeder::class,
            ModuleSeeder::class,
            StatutSeeder::class,
            TypesdemandeSeeder::class,
            TypesFormationSeeder::class,
            IngenieurSeeder::class,
            NineaSeeder::class,
            IndividuelleSeeder::class,
            CollectiveSeeder::class,
            FcollectiveSeeder::class,
            FindividuelleSeeder::class,
            TypesOperateurSeeder::class,
            OperateurSeeder::class,
            EtablissementSeeder::class,
            ScolariteSeeder::class,
            EtudeSeeder::class,
            FiliereSeeder::class,
            TypepchargeSeeder::class,
            PchargeSeeder::class,
            FilierespecialiteSeeder::class,
        ]);
    }
}
