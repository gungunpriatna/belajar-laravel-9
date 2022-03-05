<?php

namespace Tests;

use App\Models\User;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost';

    protected function adminUserSigningIn($userDataOverrides = [])
    {
        $user = $this->createUser('admin', $userDataOverrides);
        $this->actingAs($user);

        return $user;
    }
    protected function createUser($role='admin', $userDataOverrides = [])
    {
        $user = User::factory()->create($userDataOverrides);
        $user->assignRole($role);
        return $user;
    }
}
