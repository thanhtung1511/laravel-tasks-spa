<?php

namespace Database\Seeders\Auth;

use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserTableSeeder.
 */
class UserTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $users =
            [
                [
                    'id' => 1,
                    'name' => 'Admin',
                    'email' => 'admin@admin.com',
                    'password' => Hash::make('admin', []),
                    'email_verified_at' => now(),
                ],
                [
                    'id' => 2,
                    'name' => 'User',
                    'email' => 'user@user.com',
                    'password' => Hash::make('default', []),
                    'email_verified_at' => now(),
                ],
            ];
        User::insert($users);

        $this->enableForeignKeys();
    }
}
