<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task(): void
    {
        $payload = [
            'title' => 'Test Task',
            'description' => 'Test description',
            'status' => 'pending',
            'due_at' => now()->addDay()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => [
                'id',
                'title',
                'description',
                'status',
                'due_at',
                'created_at',
                'updated_at',
            ]]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Test Task',
        ]);
    }

    public function test_cannot_create_task_with_past_due_date(): void
    {
        $payload = [
            'title' => 'Invalid Task',
            'status' => 'pending',
            'due_at' => now()->subDay()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertStatus(422);
    }

    public function test_can_retrieve_all_tasks(): void
    {
        Task::factory()->create([
            'due_at' => now()->addDay(),
        ]);

        $response = $this->getJson('/api/tasks');

        $response->assertStatus(200)
            ->assertJsonStructure(['data']);
    }

    public function test_can_update_task_status(): void
    {
        $task = Task::factory()->create([
            'status' => 'pending',
            'due_at' => now()->addDay(),
        ]);

        $response = $this->patchJson("/api/tasks/{$task->id}/status", [
            'status' => 'completed',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'completed',
        ]);
    }

    public function test_can_delete_task(): void
    {
        $task = Task::factory()->create([
            'due_at' => now()->addDay(),
        ]);

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);

        $this->assertSoftDeleted('tasks', [
            'id' => $task->id,
        ]);
    }
}
