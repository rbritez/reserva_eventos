<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use WithFaker;

    protected function createUser(string $role): User
    {
        $role = Role::factory()->create(['name' => $role]);
        $user =  User::factory()->create();
        $user->roles()->attach($role);
        return $user;
    }

    protected function createTokenUser(string $role): string
    {
        $user = $this->createUser($role);
        $user->createToken('Test Token')->accessToken;
        $token = \JWTAuth::fromUser($user);
        return $token;
    }
}
