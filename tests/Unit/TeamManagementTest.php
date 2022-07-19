<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
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

    public function testChangePasswordTeamUser()
    {
        $this->post('/login',$this->adminUser);
        $this->post('/teams/manage/create-user',$this->userData);

        $createdTeamUser = User::where([
            'name' => 'Test User'])
            ->get()[0];

        $oldPassword = $createdTeamUser->password;
        
        //verify current password before change it
        $this->assertDatabaseHas('users',[
            'password' => $oldPassword
        ]);

        //now we will change the password user
        $this->post("/user/update-password/{$createdTeamUser->id}",['password' => 'abcdeifh1']);
        
        //verify current password has missing
        $this->assertDatabaseMissing('users',[
            'password' => $oldPassword
        ]);
    }

    public function testAdminUsersCanOnlyUpgradeInfosFromOwnTeamUsers()
    {
        //login and create team user
        $this->post('/login',$this->adminUser);
        $this->post('/teams/manage/create-user',$this->userData);

        //change team from current team user
        $teamUser = User::find(2);
        $teamUser->team_id = 2;
        $teamUser->save();

        $userId = 2;
        $newName = 'new name';
        $newEmail = 'new@email.com';

        //trying to update admin user info
        $this->post('user/2',[
            'id' => $userId,
            'name' => $newName,
            'email' => $newEmail

        ]);

        //assert the change was failed (nothing was changed) 
        $this->assertDatabaseHas('users',[
            'name' => $this->userData['name'],
            'email' => $this->userData['email'],
        ]);

        $currentTeamUserPasswordHash = User::find(2)->password;

        //trying to update admin user password
        $this->post('users/update-password/2',[
            'password' => '8192389123912'
        ]);

        //assert the change was failed (nothing was changed)
        $this->assertDatabaseHas('users',[
            'password' => $currentTeamUserPasswordHash
        ]);

    }

}
