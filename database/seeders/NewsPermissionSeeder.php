<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class NewsPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view news']);
        Permission::create(['name' => 'create news']);
        Permission::create(['name' => 'edit news']);
        Permission::create(['name' => 'delete news']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Writer']);
        $role1->givePermissionTo('view news');
        $role1->givePermissionTo('create news');
        $role1->givePermissionTo('edit news');
        $role1->givePermissionTo('delete news');

        $role2 = Role::create(['name' => 'Admin']);
        $role2->givePermissionTo('view news');
        $role2->givePermissionTo('create news');
        $role2->givePermissionTo('edit news');
        $role2->givePermissionTo('delete news');

        $role2->givePermissionTo('view user');
        $role2->givePermissionTo('edit user');

        $role3 = Role::create(['name' => 'Super Admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Demo User',
            'email' => 'tester@badungkab.go.id',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@badungkab.go.id',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Ajik Admin',
            'email' => 'superadmin@badungkab.go.id',
        ]);
        $user->assignRole($role3);
    }
}
