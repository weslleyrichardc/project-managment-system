<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creation of a new project
     */
    public function test_can_create_project(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            'user_id' => $user->id,
        ]);

        $this
            ->actingAs($user)
            ->post('/api/projects', [
                'name' => $project->name,
                'description' => $project->description,
            ])
            ->assertCreated();

        $this->assertDatabaseHas('projects', [
            'name' => $project->name,
            'description' => $project->description,
        ]);
    }

    /**
     * Test the updating of a project
     */
    public function test_can_update_project(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create([
            'user_id' => $user->id,
        ]);
        $newProject = Project::factory()->make();

        $this
            ->actingAs($user)
            ->put('/api/projects/'.$project->id, [
                'name' => $newProject->name,
                'description' => $newProject->description,
            ])
            ->assertOk();

        $this->assertDatabaseHas('projects', [
            'name' => $newProject->name,
            'description' => $newProject->description,
        ]);
    }

    /**
     * Test the deletion of a project
     */
    public function test_can_delete_project(): void
    {
        $this->withoutExceptionHandling();

        $project = Project::factory()->create();

        $response = $this
                        ->actingAs(User::findOrFail($project->user_id))
                        ->delete("/api/projects/{$project->id}");

        $this->assertDatabaseMissing('projects', $project->toArray());

        $response->assertNoContent();
    }
}
