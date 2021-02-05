<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $availability = [
            'monday' => [
                ['from' => '08:00', 'to' => '18:00']
            ],
            'tuesday' => [
                ['from' => '08:00', 'to' => '18:00']
            ],
            'wednesday' => [
                ['from' => '08:00', 'to' => '18:00']
            ],
            'thursday' => [
                ['from' => '08:00', 'to' => '18:00']
            ],
            'friday' => [
                ['from' => '08:00', 'to' => '18:00']
            ],
            'saturday' => [
                ['from' => '09:00', 'to' => '12:00'],
                ['from' => '14:00', 'to' => '17:00'],
            ],
            'sunday' => [
                ['from' => '06:00', 'to' => '09:00'],
                ['from' => '14:00', 'to' => '17:00'],
            ],
        ];

        $employee = Employee::create([
            'rung' => Employee::rungs()[random_int(0, 2)],
            'languages' => ['JAVA','PHP', 'JavaScript', 'Kotlin'],
            'availability' => $availability,
            'contact' => [
                'phone' => '+254700016349',
                'twitter' => 'https://twitter.com/AzengaKevin4',
                'facebook' => 'https://web.facebook.com/azenga.kevin.1'
            ]
        ]);
        
        $employee->user()->create([
            'name' => 'John Nyange',
            'email' => 'jnmajanga@gmail.com',
            'password' => bcrypt('pa$$word')
        ]);
        
    }
}
