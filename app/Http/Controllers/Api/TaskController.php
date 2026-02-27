<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function __construct(private TaskService $taskService)
    {
    }

    public function indexPage(Request $request): JsonResponse
    {
        $tasks = $this->taskService->getAll(
            $request->query('status'),
            $request->query('per_page', 2)
        );

        return response()->json([
            'data' => TaskResource::collection($tasks->items()),
            'meta' => [
                'current_page' => $tasks->currentPage(),
                'last_page' => $tasks->lastPage(),
                'per_page' => $tasks->perPage(),
                'total' => $tasks->total(),
            ],
        ]);
    }

    public function storeTask(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->create($request->validated());
        Log::info($task->id);
        return response()->json([
            'data' => new TaskResource($task)
        ], 201);
    }

    public function showTask(string $id): JsonResponse
    {
        $task = $this->taskService->getById($id);

        return response()->json([
            'data' => new TaskResource($task)
        ]);
    }

    public function updateStatus(UpdateTaskStatusRequest $request, string $id): JsonResponse
    {
        $task = $this->taskService->updateStatus($id, $request->validated()['status']);

        return response()->json([
            'data' => new TaskResource($task)
        ]);
    }

    public function deleteTask(string $id): JsonResponse
    {
        $this->taskService->deleteTask($id);

        return response()->json(null, 204);
    }
}
