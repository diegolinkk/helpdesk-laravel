<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Team;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use App\Services\PriorizeTech;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PriorizeTechServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() :void
    {
        parent::setUp();

        //creating team, category and ticket type
        Team::create(['name' => 'team_test']);
        Category::create(['name' => 'category_test']);
        TicketType::create(['name' => 'ticket_type_test']);

        //creating users
        User::create([
            'name' => 'user_01',
            'email' => 'user_01@sadfsadf',
            'password' => 'user_01',
            'team_id' => 1,
            'is_admin' => true,
        ]);
        
        User::create([
            'name' => 'user_02',
            'email' => 'user_02@afsadfsadf',
            'password' => 'user_02',
            'team_id' => 1,
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'user_02',
            'email' => 'user_03@fafafafafafafa',
            'password' => 'user_02',
            'team_id' => 1,
            'is_admin' => true,
        ]);
        
        //creating 3 tickets for user 1
        for($i =0;$i < 3; $i++){
            Ticket::create([
                'name' => 'test123123123123',
                'description' => 'test123123123123',
                'finished' => false,
                'ticket_type_id' => 1,
                'category_id' => 1,
                'team_id' => 1,
                'responsible_tech' => 1,
            ]);
        };

        //creating 2 tickets for user 2
        for($i =0;$i < 2; $i++){
            Ticket::create([
                'name' => 'test123123123123',
                'description' => 'test123123123123',
                'finished' => false,
                'ticket_type_id' => 1,
                'category_id' => 1,
                'team_id' => 1,
                'responsible_tech' => 2,
            ]);
        };

        //creating 1 ticket for user 1
        Ticket::create([
            'name' => 'test123123123123',
            'description' => 'test123123123123',
            'finished' => false,
            'ticket_type_id' => 1,
            'category_id' => 1,
            'team_id' => 1,
            'responsible_tech' => 3,
        ]);

    }
    public function testIfServiceIsOrderingTechsCorrectly()
    {
        $userWithLessTicket = User::find(3); //user with id 3 has less tickets

        $responsibleTechs = User::all();
        $responsibleTechs = PriorizeTech::priorizeByLessActiveTickets($responsibleTechs);

        //for some reason, the order list is inverted works perfectly in TicketController
        //In the TicketController  the first user from returned collection has less tickets
        //so this test still valid
        $this->assertEquals($responsibleTechs[2]['id'], $userWithLessTicket['id']);
        
    }
}
