<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\User;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        return [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status'      => $this->faker->randomElement(['open', 'in_progress', 'completed']),
            'due_date'    => $this->faker->date(),
            'user_id'     => $this->faker->randomElement($userIds),
        ];
    }
}
