<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAuthenticationTest extends TestCase
{
    use RefreshDatabase;
    
    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('passport:install');
    }
    
    /** @group user */
    public function test_a_user_can_login()
    {
        $this->withoutExceptionHandling();

        
        $admin = Admin::create();

        $admin->user()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('elephant69')
        ]);

        $response = $this->json('POST', route('login'), [
            'email' => 'admin@gmail.com',
            'password' => 'elephant69'
        ]);

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'user',
                'access_token'
            ]
        ]);

    }
}
