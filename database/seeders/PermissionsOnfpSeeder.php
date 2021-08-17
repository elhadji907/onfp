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
        Permission::create(['name' => 'edit courriers']);
        Permission::create(['name' => 'delete courriers']);

        Permission::create(['name' => 'edit factures']);
        Permission::create(['name' => 'delete factures']);

        Permission::create(['name' => 'edit demandes']);
        Permission::create(['name' => 'delete demandes']);

        Permission::create(['name' => 'edit modules']);
        Permission::create(['name' => 'delete modules']);

        Permission::create(['name' => 'edit operateurs']);
        Permission::create(['name' => 'delete operateurs']);

        Permission::create(['name' => 'edit formations']);
        Permission::create(['name' => 'delete formations']);
 
        // create roles and assign created permissions
 
        // this can be done as separate statements
        $role = Role::create(['name' => 'Beneficiaire']);
        $role->givePermissionTo('edit demandes', 'delete demandes');
 
        // or may be done by chaining
        $role = Role::create(['name' => 'Courrier'])
             ->givePermissionTo(['edit courriers', 'delete courriers']);

        $role = Role::create(['name' => 'ACourrier'])
             ->givePermissionTo(['edit courriers']);
 
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Administrateur']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Gestionnaire']);
        $role->givePermissionTo(['edit courriers', 'edit demandes', 'edit demandes', 'edit courriers']);

        $role = Role::create(['name' => 'Demandeur']);
        $role->givePermissionTo(['edit demandes', 'delete demandes']);

        $role = Role::create(['name' => 'Operateur']);
        $role->givePermissionTo(['edit operateurs', 'delete operateurs']);

        $role = Role::create(['name' => 'Comptable']);
        $role->givePermissionTo('edit factures', 'delete factures');

        $role = Role::create(['name' => 'AComptable']);
        $role->givePermissionTo('edit demandes');

        $role = Role::create(['name' => 'DPP']);
        $role = Role::create(['name' => 'ADPP']);
        $role = Role::create(['name' => 'DIOF']);
        $role = Role::create(['name' => 'ADIOF']);
        $role = Role::create(['name' => 'DEC']);
        $role = Role::create(['name' => 'ADEC']);
        $role = Role::create(['name' => 'Ingenieur']);
        $role = Role::create(['name' => 'COM']);
        $role = Role::create(['name' => 'ACOM']);
        $role = Role::create(['name' => 'Visiteur']);
        $role = Role::create(['name' => 'DAF']);
        $role = Role::create(['name' => 'FDAF']);
        $role = Role::create(['name' => 'RHDAF']);
        $role = Role::create(['name' => 'LOGDAF']);
        $role = Role::create(['name' => 'PRDPP']);
        $role = Role::create(['name' => 'PLDPP']);
        $role = Role::create(['name' => 'Consultant']);
        $role = Role::create(['name' => 'SUIVI']);
        $role = Role::create(['name' => 'EVDEC']);
        $role = Role::create(['name' => 'Nologin']);
    }
}
