<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
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
            'create offerings',
            'edit offerings',
            'delete offerings',
            'create expenses',
            'edit expenses',
            'delete expenses',

            // Document permissions
            'view documents',
            'create documents',
            'edit documents',
            'delete documents',

            // User management permissions
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Report permissions
            'view reports',
            'export reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $pastorRole = Role::create(['name' => 'pastor']);
        $treasurerRole = Role::create(['name' => 'treasurer']);
        $ministryCoordinatorRole = Role::create(['name' => 'ministry_coordinator']);
        $memberRole = Role::create(['name' => 'member']);

        // Assign permissions to roles
        $adminRole->givePermissionTo(Permission::all());

        $pastorRole->givePermissionTo([
            'view members', 'create members', 'edit members',
            'view ministries', 'create ministries', 'edit ministries',
            'view events', 'create events', 'edit events',
            'view finances', 'create offerings', 'edit offerings',
            'view documents', 'create documents', 'edit documents',
            'view reports', 'export reports',
        ]);

        $treasurerRole->givePermissionTo([
            'view members',
            'view ministries',
            'view events',
            'view finances', 'create offerings', 'edit offerings', 'delete offerings',
            'create expenses', 'edit expenses', 'delete expenses',
            'view documents', 'create documents', 'edit documents',
            'view reports', 'export reports',
        ]);

        $ministryCoordinatorRole->givePermissionTo([
            'view members',
            'view ministries', 'create ministries', 'edit ministries',
            'view events', 'create events', 'edit events',
            'view documents', 'create documents', 'edit documents',
            'view reports',
        ]);

        $memberRole->givePermissionTo([
            'view members',
            'view ministries',
            'view events',
            'view documents',
        ]);

        // Create admin user
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@church.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');
    }
}
