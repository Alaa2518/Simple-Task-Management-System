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

        // Retrieve paginated tasks assigned to the user
        $assignedTasks = $user->tasks()->paginate($tasksPerPage);

        // Retrieve paginated tasks created by the user
        $createdTasks = Task::where('created_by', $user->id)->paginate($tasksPerPage);

        return response()->json([
            'assigned_tasks' => $assignedTasks,
            'created_tasks' => $createdTasks,
        ]);
    }
}
