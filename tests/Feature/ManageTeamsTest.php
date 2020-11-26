<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class ManageTeamsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function only_an_authenticated_user_can_create_a_team()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs(factory('App\User')->create());

        $attributes = factory('App\Team')->raw(['owner_id' => auth()->id()]);

        $this->postJson('/api/teams', $attributes);

        $this->assertDatabaseHas('teams', $attributes);

        $this->assertJson(json_encode($attributes));
    }

    /** @test */
    public function guests_cannot_create_team()
    {
        $attributes = factory('App\Team')->raw(['owner_id' => '']);
        $this->postJson('/api/teams', $attributes)->assertStatus(401);
    }

    /** @test */
    public function guests_cannot_view_teams()
    {
        $this->getJson('/api/teams')->assertStatus(401);
    }

    /** @test */
    public function guests_cannot_view_a_single_team()
    {
        $team = factory('App\Team')->create();
        $this->getJson($team->path())->assertStatus(401);
    }

    /** @test */
    public function a_team_requires_a_name()
    {
        Passport::actingAs(factory('App\User')->create());

        $attributes = factory('App\Team')->raw(['name' => '']);
        $this->postJson('/api/teams', $attributes)->assertStatus(422);
    }

    /** @test */
    public function a_team_requires_a_description()
    {
        Passport::actingAs(factory('App\User')->create());

        $attributes = factory('App\Team')->raw(['description' => '']);
        $this->postJson('/api/teams', $attributes)->assertStatus(422);
    }

    /** @test */
    public function a_user_can_view_a_team()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs(factory('App\User')->create());

        $team = factory('App\Team')->create();

        $this->getJson($team->path());

        $this->assertJson($team);
    }

    /** @test */
    public function a_user_cannot_create_more_than_one_team()
    {
        // $this->withoutExceptionHandling();

        Passport::actingAs(factory('App\User')->create());

        $team_attributes_1 = factory('App\Team')->raw(['owner_id' => auth()->id()]);
        $team_attributes_2 = factory('App\Team')->raw(['owner_id' => auth()->id()]);

        $this->postJson('/api/teams', $team_attributes_1)->assertStatus(200);

        $this->assertDatabaseHas('teams', $team_attributes_1);

        $this->postJson('/api/teams', $team_attributes_2)->assertStatus(422);
    }
}
