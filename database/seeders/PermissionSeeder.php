<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Create permissions
        $permissions = [
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Role permissions
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'assign permissions',

            // Permission permissions
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',

            // Lead permissions
            'view leads',
            'create leads',
            'edit leads',
            'delete leads',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $managerRole->givePermissionTo([
            'view users', 'view roles', 'view permissions',
            'view leads', 'create leads', 'edit leads',
            'assign permissions'
        ]);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo([
            'view leads', 'create leads'
        ]);

        // Assign admin role to the first user (you)
        $firstUser = \App\Models\User::first();
        if ($firstUser) {
            $firstUser->assignRole('admin');
        }
    }
}
