<?php

namespace App\Repositories;

use App\Models\Task;

class TaskRepository
{
    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(Task $task, array $data)
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task)
    {
        return $task->delete();
    }

    public function assign(Task $task, array $userIds)
    {
        $task->assignedUsers()->sync(ids: $userIds);
        return $task->load(['assignedUsers','user']);
    }

    public function updateStatus(Task $task, string $status)
    {
        $task->update(['status' => $status]);
        return $task;
    }
}
