<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creation of a new user
     */
    public function test_can_register(): void
    {
        $user = User::factory()->make();

        $response = $this->postJson('/api/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertCreated();
    }

    /**
     * Test the creation of a new user fails when the data is invalid
     */
    public function test_cannot_register(): void
    {
        $response = $this->postJson('/api/register', []);

        $response->assertJsonValidationErrors(['name', 'email', 'password']);
        $response->assertUnprocessable();
    }

    /**
     * Test the login of a user
     */
    public function test_can_login(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertJsonStructure(['token', 'token_type', 'expires_in']);
        $response->assertCreated();
    }

    /**
     * Test the login of a user fails when the data is invalid
     */
    public function test_cannot_login(): void
    {
        $response = $this->postJson('/api/login', []);

        $response->assertJsonValidationErrors(['email', 'password']);
        $response->assertUnprocessable();
    }

    /**
     * Test the logout of a user
     */
    public function test_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/logout', [], [
            'Authorization' => 'Bearer '.auth()->login($user),
        ]);

        $response->assertJsonStructure(['message']);
        $response->assertOk();
    }

    /**
     * Test the refresh of a user token
     */
    public function test_can_refresh(): void
    {
        $user = User::factory()->create();

        $response = $this->postJson('/api/refresh', [], [
            'Authorization' => 'Bearer '.auth()->login($user),
        ]);

        $response->assertJsonStructure(['user', 'token', 'token_type', 'expires_in']);
        $response->assertOk();
    }
}
