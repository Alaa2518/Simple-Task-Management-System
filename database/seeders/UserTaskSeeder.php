<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assign tasks to users
        $users = User::get();
        $tasks = Task::get();
        foreach ($users as $user) {
            $assignedTasks = $tasks->random(100);
            $user->tasks()->attach($assignedTasks->pluck('id')->toArray());
        }
    }
}
