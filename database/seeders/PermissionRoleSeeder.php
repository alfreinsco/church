<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

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
            'assign roles',

            // Permission permissions
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
            'assign permissions',

            // Member permissions
            'view members',
            'create members',
            'edit members',
            'delete members',

            // Ministry permissions
            'view ministries',
            'create ministries',
            'edit ministries',
            'delete ministries',

            // Event permissions
            'view events',
            'create events',
            'edit events',
            'delete events',

            // Finance permissions
            'view finances',
            'create finances',
            'edit finances',
            'delete finances',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles
        $superAdminRole = Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $pastorRole = Role::create(['name' => 'Pastor', 'guard_name' => 'web']);
        $secretaryRole = Role::create(['name' => 'Sekretaris', 'guard_name' => 'web']);
        $treasurerRole = Role::create(['name' => 'Bendahara', 'guard_name' => 'web']);
        $memberRole = Role::create(['name' => 'Jemaat', 'guard_name' => 'web']);

        // Assign permissions to Super Admin (all permissions)
        $superAdminRole->givePermissionTo(Permission::all());

        // Assign permissions to Admin
        $adminRole->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view roles', 'create roles', 'edit roles', 'assign roles',
            'view permissions', 'create permissions', 'edit permissions', 'assign permissions',
            'view members', 'create members', 'edit members', 'delete members',
            'view ministries', 'create ministries', 'edit ministries', 'delete ministries',
            'view events', 'create events', 'edit events', 'delete events',
            'view finances', 'create finances', 'edit finances', 'delete finances',
        ]);

        // Assign permissions to Pastor
        $pastorRole->givePermissionTo([
            'view members', 'create members', 'edit members',
            'view ministries', 'create ministries', 'edit ministries',
            'view events', 'create events', 'edit events',
            'view finances',
        ]);

        // Assign permissions to Secretary
        $secretaryRole->givePermissionTo([
            'view members', 'create members', 'edit members',
            'view ministries', 'create ministries', 'edit ministries',
            'view events', 'create events', 'edit events',
            'view finances', 'create finances', 'edit finances',
        ]);

        // Assign permissions to Treasurer
        $treasurerRole->givePermissionTo([
            'view members',
            'view ministries',
            'view events',
            'view finances', 'create finances', 'edit finances', 'delete finances',
        ]);

        // Assign permissions to Member (limited access)
        $memberRole->givePermissionTo([
            'view members',
            'view ministries',
            'view events',
        ]);
    }
}
