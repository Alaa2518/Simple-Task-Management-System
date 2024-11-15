<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponseTrait;
    // Login method
    public function login(LoginRequest $request)
    {
        try{

            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('auth_token')->plainTextToken;

                return $this->successResponse(['token' => $token,'user' => $user],
                                                'Login successful');
            }

            return $this->errorResponse('Invalid login details',401);
        }
        catch(Exception $e)
        {
            return $this->errorResponse($e->getMessage());
        }
    }

    // Logout method
    public function logout(Request $request)
    {
        try{
            $request->user()->tokens()->delete();

            return $this->successResponse(null, 'Logged out successfully', 200);
        }
        catch(Exception $e)
        {
            return $this->errorResponse($e->getMessage());
        }
    }
}
