<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use App\Repositories\UserRepository;
use Exception;

class UserController extends Controller
{
    use ApiResponseTrait;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Retrieve the list of users.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $users = $this->userRepository->getCachedUsers();

            return $this->successResponse($users, 'Users data retrieved successfully.');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
