<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    public function getById(string $id): Task
    {
        return Task::findOrFail($id);
    }

    public function updateStatus(string $id, string $status): Task
    {
        $task = Task::findOrFail($id);
        $task->update(['status' => $status]);

        return $task;
    }

    public function deleteTask(string $id): void
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }

    public function getAll(?string $status = null, int $perPage = 10)
    {
        $query = Task::query();

        if ($status) {
            $query->where('status', $status);
        }

        return $query
            ->orderBy('due_at')
            ->paginate($perPage);
    }
}
