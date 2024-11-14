<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Task;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(CommentRequest $request, Task $task)
    {
        // Prepare data for the comment
        $data = [
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ];

        // Store the comment using the repository
        $comment = $this->commentRepository->create($data);

        // Load the user relationship to include commenter details in the response
        $comment->load('user');

        return response()->json([
            'message' => 'Comment added successfully',
            'comment' => $comment
        ], 201);
    }
}
