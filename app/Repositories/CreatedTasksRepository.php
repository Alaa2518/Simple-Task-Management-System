<?php

namespace App\Repositories;

use App\Models\Task;

class CreatedTasksRepository
{
    public function getCreatedTasks($userId, $filters, $tasksPerPage)
    {
        return Task::where('user_id', $userId)
            ->when($filters['status'], function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($filters['assignee_id'], function ($query, $assigneeId) {
                return $query->whereHas('assignedUsers', function ($query) use ($assigneeId) {
                    $query->where('assign_user_tasks.user_id', $assigneeId);
                });
            })
            ->with(['user','assignedUsers','comments'])
            ->orderBy('created_at', 'DESC')
            ->paginate($tasksPerPage);
    }
}
