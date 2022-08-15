<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $correctCategory;
    private $wrongCategory;

    protected function setUp() : void
    {

        parent::setUp();

        $this->user = [
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => '123456',
            'team_name' => 'team_test',
        ];

        $this->correctCategory = [
            'name' => 'category_test',
        ];
        
        $this->wrongCategory = [
            'name' => 'ab'
        ];

        $this->post('/user/create',$this->user);
        $this->post('/login',$this->user);


    }

    public function testAssertThatUserCanCreateCategory()
    {   
        $this->assertDatabaseCount('categories',0);



        $this->post('/category',$this->correctCategory);
        $this->assertDatabaseCount('categories',1);
    }

    public function testAssertThatCategoriesWithLessThanThreeCharacteresCanNotBeCreated()
    {
        $this->assertDatabaseCount('categories',0);
        $this->post('/category',$this->wrongCategory);
        $this->assertDatabaseCount('categories',0);
    }

}
