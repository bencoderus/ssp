<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function login(?Authenticatable $user = null)
    {
        $user = $user ?? User::factory()->create();

        $this->actingAs($user);

        return $user;
    }
}
