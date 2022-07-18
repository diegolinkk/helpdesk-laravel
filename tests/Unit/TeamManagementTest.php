<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamManagementTest extends TestCase
{

    use RefreshDatabase;
    private $userData;
    private $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '12345',
            'team_name' => 'admin team'

        ];

        $this->userData = [
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => '12345',

        ];

        $this->post('/user/create',$this->adminUser);

    }

    public function testAddUserToTeam()
    {
        //login as admin user
        $this->post('/login',$this->adminUser);
        
        //for a while, the database has only admin user
        $this->assertDatabaseCount('users',1);

        //now we will create a team user
        $this->post('/teams/manage/create-user',$this->userData);
        $this->assertDataBaseCount('users',2);
    }

    public function testDeleteTeamUser()
    {
        //create admin user, login and add user to Team
        $this->post('/login',$this->adminUser);
        $this->post('/teams/manage/create-user',$this->userData);
        $this->assertDatabaseCount('users',2);

        //delete user data where id = 2
        $this->get('/user/delete/2');
        //ensure that the database now has only one record 
        $this->assertDatabaseCount('users',1);

    }

    public function testEditTeamUser()
    {
        //login
        $this->post('/login',$this->adminUser);
        //create Team user
        $this->post('/teams/manage/create-user',$this->userData);

        //edit user by route
        $newName = "new name";
        $newEmail = "new@email.com";
        
        $this->post('/user/2',[
            'id' => '2',
            'name' => $newName,
            'email' => $newEmail,
            ]);

        //assert that user was changed
        $this->assertDatabaseHas('users',[
            'name' => $newName,
            'email' => $newEmail,
        ]);
    }

}
