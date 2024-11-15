<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTaskRequest;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateStatusTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Exception;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Traits\ApiResponseTrait;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    use ApiResponseTrait;

    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    // Store a new task
    public function store(CreateTaskRequest $request)
    {
        try {
            $task = $this->taskRepository->create([
                'title'       => $request->title,
                'description' => $request->description,
                'due_date'    => $request->due_date,
                'user_id'     => Auth::id(),
                'status'      => 'open',
            ]);

            return $this->successResponse($task, 'Task created successfully.');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    // Update an existing task
    public function update(UpdateTaskRequest $request, Task $task)
    {
        try {
            $task = $this->taskRepository->update($task, [
                'title'       => $request->title,
                'description' => $request->description,
                'due_date'    => $request->due_date,
            ]);

            return $this->successResponse($task, 'Task updated successfully.');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    // Delete an existing task
    public function destroy(Task $task)
    {
        try {
            $this->taskRepository->delete($task);
            return $this->successResponse(null, 'Task deleted successfully.');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    // Assign task to users
    public function assign(AssignTaskRequest $request, Task $task)
    {
        try {
            Cache::forget('users_list');
            $task = $this->taskRepository->assign($task, $request->user_ids);

            return $this->successResponse($task, 'Task assigned successfully.');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    // Update task status
    public function updateStatus(UpdateStatusTaskRequest $request, Task $task)
    {
        try {
            Cache::forget('users_list');
            $task = $this->taskRepository->updateStatus($task, $request->status);

            return $this->successResponse($task, 'Task status updated successfully.');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
