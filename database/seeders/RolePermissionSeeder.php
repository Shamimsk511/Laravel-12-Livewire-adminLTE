<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // create permissions
        Permission::firstOrCreate(['name' => 'manage users']);
        // create roles and assign existing permissions
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $staff = Role::firstOrCreate(['name' => 'Staff']);
        $customer = Role::firstOrCreate(['name' => 'Customer']);

        $admin->givePermissionTo('manage users');
    }
}
