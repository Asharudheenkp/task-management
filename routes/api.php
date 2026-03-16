<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserAuthController;
use App\Http\Middleware\ExecutionTimeMiddleware;
use Illuminate\Support\Facades\Route;


Route::middleware(ExecutionTimeMiddleware::class)->group(function () {
    Route::post('user/registration', [UserAuthController::class, 'register']);
    Route::post('user/login', [UserAuthController::class, 'login']);

    Route::get('/tasks', [TaskController::class, 'index']);
    Route::put('/tasks/{id}/complete', [TaskController::class, 'markAsCompleted']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/tasks', [TaskController::class, 'create']);
        Route::put('/tasks/{id}/assign', [TaskController::class, 'assignTask']);
    });
});
