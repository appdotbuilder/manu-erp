<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define modules and actions
        $modules = ['sales', 'inventory', 'purchasing', 'finance', 'hr'];
        $actions = ['view', 'create', 'edit', 'delete'];

        // Create permissions for each module and action
        $permissions = [];
        foreach ($modules as $module) {
            foreach ($actions as $action) {
                $permission = Permission::create([
                    'name' => "{$action}-{$module}",
                    'display_name' => ucfirst($action) . ' ' . ucfirst($module),
                    'module' => $module,
                    'description' => "Permission to {$action} {$module} data",
                ]);
                $permissions["{$action}-{$module}"] = $permission;
            }
        }

        // Create roles
        $superAdmin = Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Admin',
            'description' => 'Has full access to all modules and features',
        ]);

        $salesManager = Role::create([
            'name' => 'sales_manager',
            'display_name' => 'Sales Manager',
            'description' => 'Can manage sales, customers, and view finished goods inventory',
        ]);

        $inventoryManager = Role::create([
            'name' => 'inventory_manager',
            'display_name' => 'Inventory Manager',
            'description' => 'Can manage all inventory and view purchase orders',
        ]);

        $partnerUser = Role::create([
            'name' => 'partner_user',
            'display_name' => 'Partner User',
            'description' => 'Focuses on sales performance and finished goods inventory',
        ]);

        // Assign permissions to Super Admin (all permissions)
        $superAdmin->permissions()->attach(collect($permissions)->pluck('id'));

        // Assign permissions to Sales Manager
        $salesManagerPermissions = [
            'view-sales', 'create-sales', 'edit-sales', 'delete-sales',
            'view-inventory', // Can view finished goods inventory
        ];
        $salesManager->permissions()->attach(
            collect($permissions)->filter(function ($permission) use ($salesManagerPermissions) {
                return in_array($permission->name, $salesManagerPermissions);
            })->pluck('id')
        );

        // Assign permissions to Inventory Manager
        $inventoryManagerPermissions = [
            'view-inventory', 'create-inventory', 'edit-inventory', 'delete-inventory',
            'view-purchasing', // Can view purchase orders
        ];
        $inventoryManager->permissions()->attach(
            collect($permissions)->filter(function ($permission) use ($inventoryManagerPermissions) {
                return in_array($permission->name, $inventoryManagerPermissions);
            })->pluck('id')
        );

        // Assign permissions to Partner User
        $partnerUserPermissions = [
            'view-sales',
            'view-inventory', // Only finished goods
        ];
        $partnerUser->permissions()->attach(
            collect($permissions)->filter(function ($permission) use ($partnerUserPermissions) {
                return in_array($permission->name, $partnerUserPermissions);
            })->pluck('id')
        );

        // Create or update users and assign roles
        $testUser = User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $testUser->roles()->attach($superAdmin);

        $partnerUserAccount = User::updateOrCreate(
            ['email' => 'partner@example.com'],
            [
                'name' => 'Partner User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $partnerUserAccount->roles()->attach($partnerUser);

        $salesManagerAccount = User::updateOrCreate(
            ['email' => 'sales_manager@example.com'],
            [
                'name' => 'Sales Manager',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $salesManagerAccount->roles()->attach($salesManager);

        $inventoryManagerAccount = User::updateOrCreate(
            ['email' => 'inventory_manager@example.com'],
            [
                'name' => 'Inventory Manager',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $inventoryManagerAccount->roles()->attach($inventoryManager);
    }
}