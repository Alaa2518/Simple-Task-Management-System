<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Task;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;
use App\Repositories\CommentRepository;

class CommentController extends Controller
{
    use ApiResponseTrait;
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentRequest $request, Task $task)
    {
        try{
            $data = [
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'comment' => $request->content,
            ];

            // Store the comment using the repository
            $comment = $this->commentRepository->create($data);

            // Load the user relationship to include commenter details in the response
            $comment->load('user');
            return $this->successResponse(
                $comment
            , 'Comment added successfully');

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }


    }
}
