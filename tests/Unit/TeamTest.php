<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class TeamTest extends TestCase
{
	use RefreshDatabase;
	
    /** @test */
    public function it_has_a_path()
    {
    	$team = factory('App\Team')->create();

    	$this->assertEquals('/api/teams/' . $team->id, $team->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
    	$team = factory('App\Team')->create();
    	
    	$this->assertInstanceOf(User::class, $team->owner);
    }
}
