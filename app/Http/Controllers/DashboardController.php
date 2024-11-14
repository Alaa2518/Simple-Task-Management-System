<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $tasksPerPage = 10; // Number of tasks per page

        // Retrieve filters from the request
        $status = $request->input('status');
        $priority = $request->input('priority');
        $assigneeId = $request->input('assignee_id');

        // Filter tasks assigned to the user
        $assignedTasksQuery = $user->tasks()->when($status, function ($query, $status) {
            return $query->where('status', $status);
        })->when($priority, function ($query, $priority) {
            return $query->where('priority', $priority);
        })->when($assigneeId, function ($query, $assigneeId) {
            return $query->whereHas('users', function ($query) use ($assigneeId) {
                $query->where('users.id', $assigneeId);
            });
        });

        $assignedTasks = $assignedTasksQuery->paginate($tasksPerPage);

        // Filter tasks created by the user
        $createdTasksQuery = Task::where('created_by', $user->id)
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })->when($priority, function ($query, $priority) {
                return $query->where('priority', $priority);
            })->when($assigneeId, function ($query, $assigneeId) {
                return $query->whereHas('users', function ($query) use ($assigneeId) {
                    $query->where('users.id', $assigneeId);
                });
            });

        $createdTasks = $createdTasksQuery->paginate($tasksPerPage);

        return response()->json([
            'assigned_tasks' => $assignedTasks,
            'created_tasks' => $createdTasks,
        ]);
    }
}
