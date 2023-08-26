<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    protected function setUp():void
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    // public function testSample() {
    //     self::assertTrue(true);
    // }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userService->login("budi", "rahasia"));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userService->login("cell", "cell"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userService->login("budi", "salah"));
    }
}
