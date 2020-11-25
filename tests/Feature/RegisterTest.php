<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() : void
    {
        parent::setUp();
        \Artisan::call('passport:install',['-vvv' => true]);
    }

    /** @test */
    public function guest_with_valid_data_can_register()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password'
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    /** @test */
    public function guest_with_invalid_data_cannot_register()
    {
        $user = factory(User::class)->make();

        $response = $this->post('/api/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'invalid'
        ]);

        $response->assertStatus(422);
    }
}