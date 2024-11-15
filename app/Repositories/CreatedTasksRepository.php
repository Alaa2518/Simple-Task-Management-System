<?php

namespace App\Repositories;

use App\Models\Task;

class CreatedTasksRepository
{
    public function getCreatedTasks($userId, $filters, $tasksPerPage)
    {
        return Task::where('created_by', $userId)
            ->when($filters['status'], function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($filters['priority'], function ($query, $priority) {
                return $query->where('priority', $priority);
            })
            ->when($filters['assignee_id'], function ($query, $assigneeId) {
                return $query->whereHas('users', function ($query) use ($assigneeId) {
                    $query->where('users.id', $assigneeId);
                });
            })
            ->paginate($tasksPerPage);
    }
}
