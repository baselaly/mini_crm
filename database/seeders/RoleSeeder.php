<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = [['name' => 'admin'], ['name' => 'employee']];
        $allPermissions = ['employee-crud', 'customer-crud', 'action-crud'];
        $employeePermissions = ['customer-crud', 'action-crud'];

        foreach ($roles as $role) {
            Role::create($role);
        }

        $adminRole = Role::where('name', 'admin')->first();
        $employeeRole = Role::where('name', 'employee')->first();

        foreach ($allPermissions as $permissionsName) {
            $permission = Permission::create(['name' => $permissionsName]);
            $permission->assignRole($adminRole->id);
            if (in_array($permissionsName, $employeePermissions)) {
                $permission->assignRole($employeeRole);
            }
        }
        $admin = User::create([
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'phone' => '0125478542',
            'name' => 'super admin'
        ]);

        $admin->assignRole([$adminRole->id]);
    }
}
