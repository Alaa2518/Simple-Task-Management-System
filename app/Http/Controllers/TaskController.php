<?php
namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class TaskController extends Controller
{
    use ApiResponseTrait;
    // Store a new task
    public function store(Request $request)
    {
        try{
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

            return $this->successResponse($task,'Task created successfully.');
        }
        catch(Exception $e)
        {
            return $this->errorResponse($e->getMessage());
        }
    }

    // Update an existing task
    public function update(Request $request, Task $task)
    {
        try{
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

            return $this->successResponse($task,'Task updated successfully.');
        }
        catch(Exception $e)
        {
            return $this->errorResponse($e->getMessage());
        }
    }

    // Delete an existing task
    public function destroy(Task $task)
    {
        try{

            $task->delete();
            return $this->successResponse(null,'Task deleted successfully');
        }
        catch(Exception $e)
        {
            return $this->errorResponse($e->getMessage());
        }
    }

    // Assign task to users
    public function assign(Request $request, Task $task)
    {
        try{
            $request->validate([
                'user_ids'   => 'required|array',
                'user_ids.*' => 'exists:users,id', // Ensure each user ID exists
            ]);
            Cache::forget('users_list');

            // Attach users to the task
            $task->users()->sync($request->user_ids);

            return $this->successResponse($task->load('users'),'Task assigned successfully');
        }
        catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function updateStatus(Request $request, Task $task)
    {
        try{
            $request->validate([
                'status' => 'required|string|in:open,in_progress,completed',
            ]);

            $task->update([
                'status' => $request->status,
            ]);
            Cache::forget('users_list');

            return $this->successResponse($task,'Task status updated successfully');
        }
        catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
