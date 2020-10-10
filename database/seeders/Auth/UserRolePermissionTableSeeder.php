<?php

namespace Database\Seeders\Auth;

use App\Models\{Company, Permission, Role, User};
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRolePermissionTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $adminPermissions = Permission::all();
        $adminRole = Role::firstWhere('name', 'admin');
        $adminRole->givePermissionTo($adminPermissions);
        $this->assignRoleToAdmin($adminRole);

        $userRole = Role::firstWhere('name', 'user');
        $userPermissions = Permission::whereIn('name', ['view-task', 'complete-task']);
        $userRole->givePermissionTo($userPermissions);
        $this->assignRoleToUser($userRole);

        $this->enableForeignKeys();
    }

    protected function assignRoleToAdmin($roles)
    {
        User::firstWhere('email', 'admin@admin.com')->assignRole($roles);
    }

    protected function assignRoleToUser($roles)
    {
        User::firstWhere('email', 'user@user.com')->assignRole($roles);
    }
}
