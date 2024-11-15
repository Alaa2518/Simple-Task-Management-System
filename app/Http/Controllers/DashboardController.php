<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AssignedTasksRepository;
use App\Repositories\CreatedTasksRepository;
use Illuminate\Support\Facades\Cache;
use App\Traits\ApiResponseTrait;
use Exception;

class DashboardController extends Controller
{
    use ApiResponseTrait;

    protected $assignedTasksRepository;
    protected $createdTasksRepository;

    public function __construct(AssignedTasksRepository $assignedTasksRepository,
                                CreatedTasksRepository $createdTasksRepository)
    {
        $this->assignedTasksRepository = $assignedTasksRepository;
        $this->createdTasksRepository = $createdTasksRepository;
    }

    public function index(Request $request)
    {
        try {
            $user = $request->user();
            $tasksPerPage = $request->input('tasks_per_page', 10); // Customizable page size with a default of 10

            // Retrieve filters from the request
            $filters = [
                'status' => $request->input('status'),
                'priority' => $request->input('priority'),
                'assignee_id' => $request->input('assignee_id'),
            ];

            // Cache key with filters to differentiate cached results
            $cacheKeyAssigned = 'assigned_tasks_' . md5(json_encode([$user->id, $filters, $tasksPerPage]));
            $cacheKeyCreated = 'created_tasks_' . md5(json_encode([$user->id, $filters, $tasksPerPage]));

            // Retrieve assigned tasks from cache or query repository
            $assignedTasks = Cache::remember($cacheKeyAssigned, 3600, function () use ($user, $filters, $tasksPerPage) {
                return $this->assignedTasksRepository->getAssignedTasks($user, $filters, $tasksPerPage);
            });

            // Retrieve created tasks from cache or query repository
            $createdTasks = Cache::remember($cacheKeyCreated, 3600, function () use ($user, $filters, $tasksPerPage) {
                return $this->createdTasksRepository->getCreatedTasks($user->id, $filters, $tasksPerPage);
            });

            // Return response with pagination details
            return $this->successResponse([
                'assigned_tasks' => $assignedTasks,
                'created_tasks' => $createdTasks,
            ], 'Dashboard data retrieved successfully');

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
