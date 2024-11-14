<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']); // logout

    Route::get('/dashboard', [DashboardController::class, 'index']); // Basec Dashboard

    Route::post('/tasks', [TaskController::class, 'store']);             // Create a task
    Route::put('/tasks/{task}', [TaskController::class, 'update']);      // Update a task
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);  // Delete a task
    Route::post('/tasks/{task}/assign', [TaskController::class, 'assign']); // Assign task to users
    Route::put('/tasks/{task}/status', [TaskController::class, 'updateStatus']);

    Route::post('/tasks/{task}/comments', [CommentController::class, 'store']);

});

