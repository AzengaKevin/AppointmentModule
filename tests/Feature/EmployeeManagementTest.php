<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use App\Models\Employee;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeManagementTest extends TestCase
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
    
    /** @group employee */
    public function test_employee_creation_endpoint()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('POST', route('employees.store'), $this->data());

        $this->assertEquals(1, Employee::count());

        $employee = Employee::first();

        $this->assertNotNull($employee->user);

        $response->assertJsonStructure([
            'data'
        ]);
    }

    private function data() : array
    {
        return [
            'employee' => [
                'availability' => [
                    'monday' => [
                        [
                            'from' => '08:00',
                            'to' => '18:00'
                        ]
                    ],
                    'tuesday' => [
                        [
                            'from' => '08:00',
                            'to' => '18:00'
                        ]
                    ],
                    'wednesday' => [
                        [
                            'from' => '08:00',
                            'to' => '18:00'
                        ]
                    ],
                    'thursday' => [
                        [
                            'from' => '08:00',
                            'to' => '18:00'
                        ]
                    ],
                    'friday' => [
                        [
                            'from' => '08:00',
                            'to' => '18:00'
                        ]
                    ],
                    'saturday' => [
                        [
                            'from' => '09:00',
                            'to' => '12:00'
                        ],
                        [
                            'from' => '14:00',
                            'to' => '17:00'
                        ],
                    ],
                    'sunday' => [
                        [
                            'from' => '06:00',
                            'to' => '09:00'
                        ],
                        [
                            'from' => '14:00',
                            'to' => '17:00'
                        ],
                    ],
                ],
                'languages' => ['JAVA','PHP', 'JavaScript', 'Kotlin'],
                'rung' => Employee::rungs()[random_int(0, 2)],
                'contact' => [
                    'phone' => '+254700016349',
                    'twitter' => 'https://twitter.com/AzengaKevin4',
                    'facebook' => 'https://web.facebook.com/azenga.kevin.1'
                ]
            ],
            'user' => [
                'name' => 'Azenga Kevin',
                'email' => 'azenga.kevin7@gmail.com',
                'password' => 'elephant69'
            ]
        ];
    }
}
