<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/test-debug', function () {
    return 'THIS IS HMCTS API';
});

Route::post('/debug', function () {
    return 'POST WORKS';
});

/*
Route::middleware('throttle:60,1')
    ->prefix('api')
    ->group(function () {

        Route::get('tasks', [TaskController::class, 'index']);
        Route::post('tasks', [TaskController::class, 'store']);
        Route::get('tasks/{id}', [TaskController::class, 'show']);
        Route::patch('tasks/{id}/status', [TaskController::class, 'updateStatus']);
        Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
    });
*/
