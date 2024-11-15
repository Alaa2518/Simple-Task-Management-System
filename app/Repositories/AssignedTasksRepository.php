<?php

namespace App\Repositories;

use App\Models\User;

class AssignedTasksRepository
{
    public function getAssignedTasks(User $user, $filters, $tasksPerPage)
    {
        return $user->tasks()
            ->when($filters['status'], function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($filters['assignee_id'], function ($query, $assigneeId) {
                return $query->whereHas('assignedUsers', function ($query) use ($assigneeId) {
                    $query->where('assign_user_tasks.user_id', $assigneeId);
                });
            })
            ->paginate($tasksPerPage);
    }
}
