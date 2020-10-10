<?php

namespace Database\Seeders\Auth;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $guardName = config('access.guards.api');
        $permissions = [
            [
                'name' => 'create-task',
                'label' => 'Create Task',
                'guard_name' => $guardName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'update-task',
                'label' => 'Create Task',
                'guard_name' => $guardName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'delete-task',
                'label' => 'Delete Task',
                'guard_name' => $guardName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'show-task',
                'label' => 'Delete Task',
                'guard_name' => $guardName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'assign-task',
                'label' => 'Assign Task',
                'guard_name' => $guardName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'complete-task',
                'label' => 'Complete Task',
                'guard_name' => $guardName,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
