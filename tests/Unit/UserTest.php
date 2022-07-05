<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $userData;

    protected function setUp() : void
    {
        parent::setUp();

        $this->userData = [
            'name' => "test",
            'password' => "12345",
            'email' => "test@test.com"
        ];
    }

    public function testIfAUserWasCreated()
    {
        User::create($this->userData);
        $this->assertDatabaseCount('Users',1);
        $this->assertDatabaseHas('Users',['password' => $this->userData['password']]);
    }

    public function testCreatedUserHasAHashedPassword()
    {
        $this->post('/user/create',$this->userData);
        $this->assertDatabaseMissing('Users',['password' => $this->userData['password']]);

    }

}
