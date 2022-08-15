<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketTypeTest extends TestCase
{

    use RefreshDatabase;
    private $ticketType;
    private $wrongTicketType;

    protected function setUp() : void
    {
        parent::setUp();

        
        $this->user = [
            'name' => 'test user',
            'email' => 'test@test.com.br',
            'password' => '123456',
            'team_name' => 'test'
        ];

        //create user and login
        $this->post('/user/create',$this->user);
        $this->post('/login',$this->user);


        $this->ticketType = [
            'name' => 'printers'
        ];

        $this->wrongTicketType = [
            'name' => 'ab'
        ];

    }

    public function testCreateTicketType()
    {
        $this->assertDatabaseCount('ticket_types',0);
        $this->post('/ticket-type',$this->ticketType);
        $this->assertDatabaseCount('ticket_types',1);
    }

    public function testCreateTicketTypeWithLesThanThreeChacarterNameCanNotBeCreated()
    {
        $this->assertDatabaseCount('ticket_types',0);
        $this->post('/ticket-type',$this->wrongTicketType);
        $this->assertDatabaseCount('ticket_types',0);
    }
}
