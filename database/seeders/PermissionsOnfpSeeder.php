<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsOnfpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'courrier-list']);
        Permission::create(['name' => 'courrier-create']);
        Permission::create(['name' => 'courrier-edit']);
        Permission::create(['name' => 'courrier-delete']);

        Permission::create(['name' => 'facture-list']);
        Permission::create(['name' => 'facture-create']);
        Permission::create(['name' => 'facture-edit']);
        Permission::create(['name' => 'facture-delete']);

        Permission::create(['name' => 'module-list']);
        Permission::create(['name' => 'module-create']);
        Permission::create(['name' => 'module-edit']);
        Permission::create(['name' => 'module-delete']);

        Permission::create(['name' => 'formation-list']);
        Permission::create(['name' => 'formation-create']);
        Permission::create(['name' => 'formation-edit']);
        Permission::create(['name' => 'formation-delete']);
 
        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-edit']);
        Permission::create(['name' => 'role-delete']);
        
        Permission::create(['name' => 'demandeur-list']);
        Permission::create(['name' => 'demandeur-create']);
        Permission::create(['name' => 'demandeur-edit']);
        Permission::create(['name' => 'demandeur-delete']);
        
        Permission::create(['name' => 'operateur-list']);
        Permission::create(['name' => 'operateur-create']);
        Permission::create(['name' => 'operateur-edit']);
        Permission::create(['name' => 'operateur-delete']);
        
        Permission::create(['name' => 'ingenieur-list']);
        Permission::create(['name' => 'ingenieur-create']);
        Permission::create(['name' => 'ingenieur-edit']);
        Permission::create(['name' => 'ingenieur-delete']);

        Permission::create(['name' => 'evaluation-list']);
        Permission::create(['name' => 'evaluation-create']);
        Permission::create(['name' => 'evaluation-edit']);
        Permission::create(['name' => 'evaluation-delete']);
 
        // create roles and assign created permissions
 
        // this can be done as separate statements
        $role = Role::create(['name' => 'Beneficiaire']);
        $role->givePermissionTo('demandeur-edit', 'demandeur-delete');
 
        // or may be done by chaining
        $role = Role::create(['name' => 'Courrier']);
        $role->givePermissionTo(['courrier-create', 'courrier-edit', 'courrier-delete', 'demandeur-create', 'demandeur-edit']);

        $role = Role::create(['name' => 'ACourrier']);
        $role->givePermissionTo(['courrier-create', 'courrier-edit']);
 
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Administrateur']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Gestionnaire']);
        $role->givePermissionTo(['courrier-create', 'courrier-edit', 'courrier-delete', 'demandeur-create', 'demandeur-edit', 'demandeur-delete']);

        $role = Role::create(['name' => 'Demandeur']);
        $role->givePermissionTo(['demandeur-create', 'demandeur-edit', 'demandeur-delete']);

        $role = Role::create(['name' => 'Operateur']);
        $role->givePermissionTo(['operateur-create', 'operateur-edit', 'operateur-delete']);

        $role = Role::create(['name' => 'Comptable']);
        $role->givePermissionTo('facture-create', 'facture-edit', 'facture-delete');

        $role = Role::create(['name' => 'AComptable']);
        $role->givePermissionTo('facture-create', 'facture-edit');

        $role = Role::create(['name' => 'DPP']);

        $role = Role::create(['name' => 'ADPP']);

        $role = Role::create(['name' => 'DIOF']);
        $role->givePermissionTo('ingenieur-create', 'ingenieur-edit', 'ingenieur-delete', 'formation-create', 'formation-edit', 'formation-delete');

        $role = Role::create(['name' => 'ADIOF']);
        $role->givePermissionTo('formation-edit');

        $role = Role::create(['name' => 'DEC']);
        $role->givePermissionTo('evaluation-create', 'evaluation-edit', 'evaluation-delete', 'operateur-create', 'operateur-edit', 'operateur-delete');

        $role = Role::create(['name' => 'ADEC']);
        $role->givePermissionTo('evaluation-create', 'evaluation-edit', 'operateur-create', 'operateur-edit');

        $role = Role::create(['name' => 'Ingenieur']);
        $role->givePermissionTo('formation-edit');

        $role = Role::create(['name' => 'COM']);

        $role = Role::create(['name' => 'ACOM']);

        $role = Role::create(['name' => 'Visiteur']);

        $role = Role::create(['name' => 'DAF']);
        $role->givePermissionTo(['courrier-create', 'courrier-edit', 'courrier-delete', 'demandeur-create', 'demandeur-edit']);

        $role = Role::create(['name' => 'FDAF']);
        $role->givePermissionTo(['courrier-create', 'courrier-edit', 'courrier-delete', 'demandeur-create', 'demandeur-edit']);

        $role = Role::create(['name' => 'RHDAF']);
        $role->givePermissionTo(['courrier-create', 'courrier-edit', 'courrier-delete', 'demandeur-create', 'demandeur-edit']);

        $role = Role::create(['name' => 'LOGDAF']);
        $role->givePermissionTo(['courrier-create', 'courrier-edit', 'courrier-delete', 'demandeur-create', 'demandeur-edit']);

        $role = Role::create(['name' => 'PRDPP']);

        $role = Role::create(['name' => 'PLDPP']);

        $role = Role::create(['name' => 'Consultant']);

        $role = Role::create(['name' => 'SUIVI']);

        $role = Role::create(['name' => 'EVDEC']);

        $role = Role::create(['name' => 'Nologin']);
    }
}
