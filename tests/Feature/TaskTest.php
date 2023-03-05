<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creation of a new task
     */
    public function test_can_create_task(): void
    {
        $task = Task::factory()->create();

        $this
            ->actingAs($task->project->user)
            ->post('/api/tasks', [
                'name' => $task->name,
                'description' => $task->description,
                'project_id' => $task->project->id,
            ])
            ->assertCreated();

        $this->assertDatabaseHas('tasks', [
            'name' => $task->name,
            'description' => $task->description,
            'project_id' => $task->project->id,
        ]);
    }

    /**
     * Test the updating of a task
     */
    public function test_can_update_task(): void
    {
        $task = Task::factory()->create();
        $newTask = Task::factory()->make();

        $this
            ->actingAs($task->project->user)
            ->put('/api/tasks/'.$task->id, [
                'name' => $newTask->name,
                'description' => $newTask->description,
                'project_id' => $newTask->project->id,
            ])
            ->assertOk();

        $this->assertDatabaseHas('tasks', [
            'name' => $newTask->name,
            'description' => $newTask->description,
            'project_id' => $newTask->project->id,
        ]);
    }

    /**
     * Test the deletion of a task
     */
    public function test_can_delete_task(): void
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $this
            ->actingAs(User::findOrFail($task->project->user_id))
            ->delete('/api/tasks/'.$task->id)
            ->assertNoContent();

        $this->assertDatabaseMissing('tasks', [
            'name' => $task->name,
            'description' => $task->description,
            'project_id' => $task->project->id,
        ]);
    }
}
