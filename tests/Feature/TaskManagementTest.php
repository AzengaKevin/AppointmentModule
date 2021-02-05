<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function setup() : void
    {
        parent::setUp();

        $this->artisan('passport:install');
        
        $admin = Admin::create();

        $admin->user()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('elephant69')
        ]);

        $this->actingAs($admin->user, 'api');
    }    

    /** @group tasks */
    public function test_create_task_endpoint()
    {
        $this->withoutExceptionHandling();

        $taskData = Task::factory()->make()->toArray();

        $reponse = $this->json('POST', route('tasks.store'), $taskData);

        $this->assertEquals(1, Task::count());

        $reponse->assertJsonStructure([
            'data' => ['name', 'description']
        ]);

    }

    /** @group tasks */
    public function test_get_all_task_endpoint()
    {
        $this->withoutExceptionHandling();

        Task::factory(5)->create();

        $reponse = $this->json('GET', route('tasks.index'));

        $reponse->assertOk();

        $reponse->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'description'
                ]
            ]
        ]);
    }

    /** @group tasks */
    public function test_get_a_single_task_endpoint()
    {
        $this->withoutExceptionHandling();

        $task = Task::factory()->create();

        $reponse = $this->json('GET', route('tasks.show', $task));

        $reponse->assertJsonStructure([
            'data' => [
                'name',
                'description'
            ]
        ]);

    }
}
