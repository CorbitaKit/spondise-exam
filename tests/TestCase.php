<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public function createUser(): object
    {
        $user = User::factory()->create();
        return $user;
    }
}
