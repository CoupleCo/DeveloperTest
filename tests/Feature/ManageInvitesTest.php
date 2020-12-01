<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class ManageInvitesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_send_invite()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs(factory('App\User')->create());
        $user = factory('App\User')->create();
        $team = factory('App\Team')->create();

        $attributes = ['team_id' => $team->id, 'email' => $user->email];

        $this->postJson('/api/invites', $attributes)->assertStatus(200);

        $this->assertDatabaseHas('invites', $attributes);

        $this->assertJson(json_encode($attributes));
    }

    /** @test */
    public function cannot_send_invite_to_a_member_or_invited_user()
    {
        Passport::actingAs(factory('App\User')->create());
        $user = factory('App\User')->create();
        $team = factory('App\Team')->create();
        $invite = factory('App\Invite')->create(['team_id' => $team->id, 'email' => $user->email, 'accepted' => true]);

        $attributes = ['team_id' => $team->id, 'email' => $user->email];

        $this->postJson('/api/invites', $attributes)->assertStatus(400);
    }

    /** @test */
    public function cannot_send_invite_to_a_team_owner()
    {
        Passport::actingAs(factory('App\User')->create());
        $user = factory('App\User')->create();
        $team = factory('App\Team')->create(['owner_id' => $user->id]);
        $another_team = factory('App\Team')->create();

        $attributes = ['team_id' => $another_team->id, 'email' => $user->email];

        $this->postJson('/api/invites', $attributes)->assertStatus(400);
    }

    /** @test */
    public function cannot_send_invite_to_a_member_of_another_team()
    {
        Passport::actingAs(factory('App\User')->create());
        $user = factory('App\User')->create();
        $team = factory('App\Team')->create();
        $team->members()->save($user);
        $another_team = factory('App\Team')->create();

        $attributes = ['team_id' => $another_team->id, 'email' => $user->email];

        $this->postJson('/api/invites', $attributes)->assertStatus(400);
    }

    /** @test */
    public function guests_cannot_send_invite()
    {
        $user = factory('App\User')->create();
        $team = factory('App\Team')->create();

        $attributes = ['team_id' => $team->id, 'email' => $user->email];
        $this->postJson('/api/invites', $attributes)->assertStatus(401);
    }

    /** @test */
    public function user_can_accept_invite()
    {
        $invite = factory('App\Invite')->create();
        $this->getJson('/api/invites/' . $invite->token)->assertStatus(200);
    }

    /** @test */
    public function user_cannot_accept_already_accepted_invite()
    {
        $invite = factory('App\Invite')->create(['accepted' => true]);
        $this->getJson('/api/invites/' . $invite->token)->assertStatus(400);
    }
}
