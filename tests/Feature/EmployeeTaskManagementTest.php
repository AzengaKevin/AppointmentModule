<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Task;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTaskManagementTest extends TestCase
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

    /** @group employee-task */
    public function test_assigning_tasks_to_employee_endpoint()
    {
        $this->withoutExceptionHandling();

        //Arrange
        $employee = Employee::create([
            'rung' => Employee::rungs()[random_int(0, 2)],
            'languages' => ['JAVA','PHP', 'JavaScript', 'Kotlin'],
            'availability' => [
                'monday' => [
                    ['from' => '08:00', 'to' => '18:00']
                ]
            ],
            'contact' => [
                'phone' => '+254700016349',
                'twitter' => 'https://twitter.com/AzengaKevin4',
                'facebook' => 'https://web.facebook.com/azenga.kevin.1'
            ]
        ]);

        $tasks = Task::factory(5)->create()->pluck('id')->toArray();

        //Act

        $response = $this->json('POST', route('employees.tasks.store', $employee), [
            'tasks' => $tasks
        ]);


        //Assert

        $this->assertCount(5, $employee->tasks);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'description'
                ]
            ]
        ]);
        
    }

    /** @group employee-task */
    public function test_getting_employees_tasks()
    {
        $this->withoutExceptionHandling();

        //Arrange
        $employee = Employee::create([
            'rung' => Employee::rungs()[random_int(0, 2)],
            'languages' => ['JAVA','PHP', 'JavaScript', 'Kotlin'],
            'availability' => [
                'monday' => [
                    ['from' => '08:00', 'to' => '18:00']
                ]
            ],
            'contact' => [
                'phone' => '+254700016349',
                'twitter' => 'https://twitter.com/AzengaKevin4',
                'facebook' => 'https://web.facebook.com/azenga.kevin.1'
            ]
        ]);

        $tasks = Task::factory(5)->create()->pluck('id')->toArray(); 
        
        $employee->tasks()->attach($tasks);

        $response = $this->json('GET', route('employees.tasks.index', $employee));

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'name',
                    'description'
                ]
            ]
        ]);
    }
}
