<?php

namespace Database\Seeders\Auth;

use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

/**
 * Class PermissionRoleTableSeeder.
 */
class RoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $roles = [
            [
                'id' => 1,
                'name' => 'admin',
                'label' => config('access.roles.admin'),
                'guard_name' => config('access.guards.api'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'user',
                'label' => config('access.roles.user'),
                'guard_name' => config('access.guards.api'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        Role::insert($roles);

        $this->enableForeignKeys();
    }
}
