<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        \Artisan::call('passport:install',['-vvv' => true]);
    }

    /** @test */
    public function guest_with_valid_credentials_can_login()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    /** @test */
    public function guest_with_invalid_credentials_cannot_login()
    {
        $user = factory(User::class)->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'invalid'
        ]);

        $response->assertStatus(422);
    }

    /** @test */
    public function user_logged_in_can_logout()
    {
        $this->withoutExceptionHandling();

        Passport::actingAs(factory(User::class)->create());

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200);
    }
}
