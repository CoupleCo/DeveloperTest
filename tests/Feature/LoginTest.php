<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function can_view_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /** @test */
    public function user_with_valid_credentials_can_login()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(302);

        $this->assertAuthenticatedAs($user);
    }

    /** @test */
    public function user_with_invalid_credentials_cannot_login()
    {
        $user = factory(User::class)->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);

        $response->assertSessionHasErrors();

        $this->assertGuest();
    }

    /** @test */
    public function user_logged_in_can_logout()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/logout');

        $response->assertStatus(302);

        $this->assertGuest();
    }
}
