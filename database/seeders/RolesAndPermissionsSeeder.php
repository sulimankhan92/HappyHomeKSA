<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $superAdminRole = Role::create(['name' => 'superAdmin']);
        $employeeRole = Role::create(['name' => 'employee']);
        $customerRole = Role::create(['name' => 'customer']);

        // Create permissions
        $manageUsersPermission = Permission::create(['name' => 'manage-users']);

        // Assign permissions to roles
        $adminRole->givePermissionTo($manageUsersPermission);

//        $adminRole->attachPermission($manageUsersPermission);
    }
}
