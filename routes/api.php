<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

Route::middleware('throttle:60,1')
    ->group(function () {

        Route::get('tasks', [TaskController::class, 'indexPage']);
        Route::post('tasks', [TaskController::class, 'storeTask']);
        Route::get('tasks/{id}', [TaskController::class, 'showTask']);
        Route::patch('tasks/{id}/status', [TaskController::class, 'updateStatus']);
        Route::delete('tasks/{id}', [TaskController::class, 'deleteTask']);
    });

