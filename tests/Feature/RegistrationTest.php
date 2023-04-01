<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $this->postJson(route('user.registration'), [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ])
        ->assertCreated();

        $this->assertDatabaseHas('users', ['name' => 'Test Name']);
    }

    public function test_validation_name_is_required()
    {
        $response = $this->postJson(route('user.registration'), [
            'name' => '',
            'email' => 'test@email.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'
        ])->assertUnprocessable();

        $response->assertJsonValidationErrors(['name']);
    }

    public function test_validation_email_is_required()
    {
        $response = $this->postJson(route('user.registration'), [
            'name' => 'Test Name',
            'email' => '',
            'password' => 'password123',
            'password_confirmation' => 'password123'

        ]);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_validation_email_is_email_format()
    {
        $response = $this->postJson(route('user.registration'), [
            'name' => 'Test Name',
            'email' => 'test email',
            'password' => 'password123',
            'password_confirmation' => 'password123'

        ]);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_validation_email_is_unique()
    {
        $data = [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'password' => 'password123',
            'password_confirmation' => 'password123'

        ];
        //Insert data first
        $this->postJson(route('user.registration'),$data)->assertCreated();

        //Insert again the data to see if the validation for unique email triggers
        $response = $this->postJson(route('user.registration'), $data);
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_validation_password_is_required()
    {
        $response = $this->postJson(route('user.registration'),[
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'password' => '',
            'password_confirmation' => ''
        ]);
        
        $response->assertJsonValidationErrors(['password']);
    }

    public function test_validation_password_is_confirmed()
    {
        $response = $this->postJson(route('user.registration'),[
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'password' => 'password123',
            'password_confirmation' => 'password12345'
        ]);
        
        $response->assertJsonValidationErrors(['password']);
    }
}
