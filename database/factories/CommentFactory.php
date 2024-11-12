<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\Task;
use App\Models\User;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        $taskIds = Task::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        return [
            'comment' => $this->faker->text,
            'task_id' => $this->faker->randomElement($taskIds),
            'user_id' => $this->faker->randomElement($userIds),
        ];
    }
}
