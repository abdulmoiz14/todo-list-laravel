<?php

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/tasks', [
            'title' => 'Sample Task',
            'description' => 'This is a sample task description',
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', ['title' => 'Sample Task']);
    }

    public function test_user_can_mark_task_as_completed()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->patch("/tasks/{$task->id}");
        $response->assertRedirect('/tasks');
        $this->assertTrue(Task::first()->is_completed);
    }

    public function test_user_can_delete_task()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/tasks/{$task->id}");
        $response->assertRedirect('/tasks');
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
