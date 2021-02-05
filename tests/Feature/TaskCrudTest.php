<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    /** @group task */
    public function test_a_task_can_be_created()
    {
        $this->withoutExceptionHandling();

        $taskData = Task::factory()->make()->toArray();

        Task::create($taskData);

        $this->assertTrue(Task::where('name', $taskData['name'])->exists());

    }
}
