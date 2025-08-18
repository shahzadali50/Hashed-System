<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // ✅ Define all permissions
        $permissions = [
            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Lead permissions
            'view leads',
            'create leads',
            'edit leads',
            'delete leads',
        ];

        // ✅ Create permissions (if not exists)
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // ✅ Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $adminRole      = Role::firstOrCreate(['name' => 'admin']);
        $agentRole      = Role::firstOrCreate(['name' => 'agent']);

        // ✅ Assign permissions
        $superAdminRole->givePermissionTo(Permission::all()); // 🚀 ALL permissions
        $adminRole->syncPermissions([
            'view users',
            'create users',
            'edit users',
            'delete users',
            'view leads',
            'create leads',
            'edit leads',
            'delete leads',
        ]);    // All permissions (like before)

        // 🚀 Agent can ONLY view leads
        $agentRole->syncPermissions([
            'view leads',
        ]);

        // ✅ Assign super_admin role to the very first user
        $firstUser = \App\Models\User::first();
        if ($firstUser && !$firstUser->hasRole('super_admin')) {
            $firstUser->assignRole('super_admin');
        }
    }
}
