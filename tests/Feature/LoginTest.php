<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_login()
    {
        $user = $this->createUser();
        $response = $this->postJson(route('user.login'),[
            'email' => $user->email,
            'password' => 'password',
        ])->assertOk();

        $this->assertArrayHasKey('token', $response->json());
    }

    public function test_user_cannot_login_if_wrong_email()
    {
        $user = $this->createUser();
        $this->postJson(route('user.login'),[
            'email' => 'test@email.com',
            'password' => 'password'
        ])->assertUnauthorized();
    }

    public function test_user_cannot_login_if_wrong_password()
    {
        $user = $this->createUser();

        $this->postJson(route('user.login'),[
            'email' => $user->email,
            'password' => 'pasword12345'
        ])->assertUnauthorized();
    }
}
