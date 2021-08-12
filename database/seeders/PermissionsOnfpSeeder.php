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
         Permission::create(['name' => 'publish courriers']);
         Permission::create(['name' => 'unpublish courriers']);

         Permission::create(['name' => 'edit demandes']);
         Permission::create(['name' => 'delete demandes']);
         Permission::create(['name' => 'publish demandes']);
         Permission::create(['name' => 'unpublish demandes']);
 
         // create roles and assign created permissions
 
         // this can be done as separate statements
         $role = Role::create(['name' => 'writer']);
         $role->givePermissionTo('edit courriers', 'delete courriers');
 
         // or may be done by chaining
         $role = Role::create(['name' => 'Courrier'])
             ->givePermissionTo(['publish courriers', 'unpublish courriers']);
 
         $role = Role::create(['name' => 'super-admin']);
         $role->givePermissionTo(Permission::all());

         $role = Role::create(['name' => 'Administrateur']);
         $role->givePermissionTo(Permission::all());

         $role = Role::create(['name' => 'Gestionnaire']);
         $role->givePermissionTo(['edit courriers', 'edit demandes', 'publish demandes', 'publish courriers']);

         $role = Role::create(['name' => 'Demandeur']);
         $role->givePermissionTo(['publish demandes', 'unpublish demandes']);

    }
}
