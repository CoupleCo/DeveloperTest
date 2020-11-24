<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTeamsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function only_an_authenticated_user_can_create_a_team()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Team')->raw(['owner_id' => auth()->id()]);

        $this->post('teams', $attributes);

        $this->assertDatabaseHas('teams', $attributes);

        $this->assertJson(json_encode($attributes));
    }

    /** @test */
    public function guests_cannot_create_team()
    {
        $attributes = factory('App\Team')->raw(['owner_id' => '']);
        $this->post('teams', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_teams()
    {
        $this->get('teams')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_a_single_team()
    {
        $team = factory('App\Team')->create();
        $this->get($team->path())->assertRedirect('login');
    }

    /** @test */
    public function a_team_requires_a_name()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Team')->raw(['name' => '']);
        $this->post('teams', $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_team_requires_a_description()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Team')->raw(['description' => '']);
        $this->post('teams', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_view_a_team()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $team = factory('App\Team')->create();

        $this->get($team->path());

        $this->assertJson($team);
    }

    /** @test */
    public function a_user_cannot_create_more_than_one_team()
    {
        // $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $team_attributes_1 = factory('App\Team')->raw(['owner_id' => auth()->id()]);
        $team_attributes_2 = factory('App\Team')->raw(['owner_id' => auth()->id()]);

        $this->post('teams', $team_attributes_1);

        $this->assertDatabaseHas('teams', $team_attributes_1);

        $this->post('teams', $team_attributes_2)->assertSessionHasErrors('owner_id');
    }
}
