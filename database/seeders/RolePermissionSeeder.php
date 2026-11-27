<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view products',
            'create products',
            'edit products',
            'withdraw products',
            'view withdrawal history',
            'manage product status',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $driver = Role::firstOrCreate([
            'name' => 'driver',
            'guard_name' => 'web',
        ]);

        $admin->syncPermissions([
            'view products',
            'create products',
            'edit products',
            'view withdrawal history',
            'manage product status',
        ]);

        $driver->syncPermissions([
            'view products',
            'withdraw products',
        ]);

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
