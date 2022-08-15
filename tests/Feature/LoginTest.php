<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    private $user;

    protected function setUp() : void
    {
        parent::setUp();
        $this->user = [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'test12345#',
            'team_name' => 'team_test',
        ];

    }

    public function testIfLoginIsWorkingCorrectly()
    {
        //assert if user can't access a protected login
        $response = $this->get('/ticket');
        $response->assertStatus(302);

        //creating a user
        $this->post('/user/create',$this->user);

        //now, the user will login...
        $this->post('login',$this->user);

        //then... the response must be ok (statuscode 200)
        $response = $this->get('/ticket');
        $response->assertStatus(200);


    }
}
