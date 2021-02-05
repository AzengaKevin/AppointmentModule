<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Employee;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeCrudTest extends TestCase
{
    use RefreshDatabase;
    
    /** @group employees */
    public function test_employee_can_be_created()
    {

        $availability = [
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
        ];

        Employee::create([
            'rung' => Employee::rungs()[random_int(0, 2)],
            'languages' => json_encode(['JAVA','PHP', 'JavaScript', 'Kotlin']),
            'availability' => json_encode($availability),
            'contact' => json_encode([
                'phone' => '+254700016349',
                'twitter' => 'https://twitter.com/AzengaKevin4',
                'facebook' => 'https://web.facebook.com/azenga.kevin.1'
            ])
        ]);


        $this->assertEquals(1, Employee::count());
    }
}
