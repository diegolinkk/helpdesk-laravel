<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketsTest extends TestCase
{

    use RefreshDatabase;

    private $user;
    private $ticket;
    private $ticketType;
    private $category;

    protected function setUp() : void
    {
        parent::setUp();

        $this->user = [
            'name' => 'test user',
            'email' => 'test@test.com.br',
            'password' => '123456',
            'team_name' => 'test'
        ];

        $this->ticketType = [
            'name' => 'printers'
        ];

        $this->category = [
            'name' => 'category_test',
        ];

        //create user and login
        $this->post('/user/create',$this->user);
        $this->post('/login',$this->user);

        //create category
        $this->post('/category',$this->category);

        //create ticket type
        $this->post('/ticket-type',$this->ticketType);

        $this->ticket = [
            'name' => 'ticket test',
            'description' => 'ticket test 1234',
            'type_id' => 1,
            'category_id' => 1,
            'responsible_tech' => 1,
            'created_date' => '2022-04-14 23:48:00',
        ];

    }

    public function testCreateTicket()
    {
        $this->assertDatabaseCount('tickets',0);
        $this->post('ticket/create',$this->ticket);
        $this->assertDatabaseCount('tickets',1);
    }

    public function testUserCanNotCreateTicketWithNameWithLessThanThreeCharacters()
    {
        $this->ticket['name'] = 'abc';
        $this->assertDatabaseCount('tickets',0);
        $this->post('ticket/create',$this->ticket);
        $this->assertDatabaseCount('tickets',0);

    }
    public function testUserCanNotCreateTicketWithDescriptionWithLessThanThreeCharacters()
    {
        $this->ticket['description'] = 'abcdefghi';
        $this->assertDatabaseCount('tickets',0);
        $this->post('ticket/create',$this->ticket);
        $this->assertDatabaseCount('tickets',0);
    }

    public function testUpdateTicketData()
    {
        $newData = [
            'name' => 'new data',
            'description' => 'new description for test',
        ];

        $this->post('ticket/create',$this->ticket);

        $this->post('/ticket/1/',$newData);

        $this->assertDatabaseHas('tickets',$newData);
    }

    public function testFinishTicket()
    {
        $this->post('ticket/create',$this->ticket);
        $this->assertDatabaseHas('tickets',['finished' => false]);
        $this->get('/ticket/1/finish');
        $this->assertDatabaseHas('tickets',['finished' => true]);
    }

}
