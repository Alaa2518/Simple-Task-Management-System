<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attachment;
use App\Models\Task;
use App\Models\User;

class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;

    public function definition()
    {
        $taskIds = Task::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        return [
            'file_path' => $this->faker->filePath(),
            'name'      => $this->faker->word,
            'extension' => $this->faker->fileExtension,
            'user_id'   => $this->faker->randomElement($userIds),
            'task_id'   => $this->faker->randomElement($taskIds),
        ];
    }
}
