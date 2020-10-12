<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

/**
 * Class UserTableSeeder.
 */
class TaskTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /** @var Collection */
    private $users;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();
        for ($i = 1; $i < 40; $i++) {
            Task::factory()->create(
                [
                    'assigner_id' => $this->getAdmin()->id,
                    'assignee_id' => $this->getUser()->id,
                    'status' => \App\Models\Task::STATUS_ASSIGNED,
                ]
            );
        }

        $this->enableForeignKeys();
    }

    private function loadUsers()
    {
        if (!$this->users) {
            $this->users = User::all();
        }
    }

    private function getAdmin()
    {
        $this->loadUsers();

        return $this->users->filter(
            function (User $user) {
                return $user->isAdmin();
            }
        )->first();
    }

    private function getUser()
    {
        $this->loadUsers();
        return $this->users->filter(
            function (User $user) {
                return !$user->isAdmin();
            }
        )->random();
    }
}
