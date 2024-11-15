<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Cache;

class UserController extends Controller
{
    use ApiResponseTrait;
    public function index()
    {
        try{
            $users = Cache::remember('users_list', 3600, function () {
                return User::select('id', 'name')->get();
            });

            return $this->successResponse($users,'Users data retrieved successfully.');
        }
        catch(Exception $e)
        {
            return $this->errorResponse($e->getMessage());
        }

    }
}
