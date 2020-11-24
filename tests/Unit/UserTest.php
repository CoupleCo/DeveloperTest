<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Team;

class UserTest extends TestCase
{
	use RefreshDatabase;

    /** @test */
    public function it_can_be_a_team_owner()
    {
    	$user = factory('App\User')->create();
    	$team = factory('App\Team')->create(['owner_id' => $user->id]);
    	
    	$this->assertInstanceOf(Team::class, $user->team);
    }
}
