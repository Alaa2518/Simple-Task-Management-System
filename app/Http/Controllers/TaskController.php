<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
        ]);

        $task = Task::create([
            'title'       => $request->title,
            'description' => $request->description,
            'due_date'    => $request->due_date,
            'user_id'     => Auth::id(),
            'status'      => 'open',
        ]);

        return response()->json(['task' => $task, 'message' => 'Task created successfully'], 200);
    }

    // Update an existing task
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
        ]);

        $task->update([
            'title'       => $request->title,
            'description' => $request->description,
            'due_date'    => $request->due_date,
        ]);

        return response()->json(['task' => $task, 'message' => 'Task updated successfully']);
    }

    // Delete an existing task
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task); // Ensure the user has permission to delete the task

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }

    // Assign task to users
    public function assign(Request $request, Task $task)
    {
        $request->validate([
            'user_ids'   => 'required|array',
            'user_ids.*' => 'exists:users,id', // Ensure each user ID exists
        ]);

        // Attach users to the task
        $task->users()->sync($request->user_ids);

        return response()->json(['task' => $task->load('users'), 'message' => 'Task assigned successfully']);
    }

    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|string|in:open,in_progress,completed',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return response()->json(['task' => $task, 'message' => 'Task status updated successfully']);
    }
}
