<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationSecurityTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_is_available(): void
    {
        $this->get('/')
            ->assertOk();
    }

    public function test_guest_is_redirected_from_dashboard(): void
    {
        $this->get('/dashboard')
            ->assertRedirect(route('login.standard.form'));
    }

    public function test_standard_login_authenticates_valid_user(): void
    {
        $user = User::factory()->create([
            'email' => 'standard@example.com',
            'password' => 'StrongPassword123!',
        ]);

        $response = $this->post(route('login.standard'), [
            'email' => $user->email,
            'password' => 'StrongPassword123!',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_secure_login_authenticates_valid_user(): void
    {
        $user = User::factory()->create([
            'email' => 'secure@example.com',
            'password' => 'StrongPassword123!',
        ]);

        $response = $this->post(route('login.secure'), [
            'email' => $user->email,
            'password' => 'StrongPassword123!',
        ]);

        $response->assertRedirect(route('dashboard'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_secure_login_rejects_invalid_credentials(): void
    {
        User::factory()->create([
            'email' => 'secure@example.com',
            'password' => 'StrongPassword123!',
        ]);

        $response = $this->post(route('login.secure'), [
            'email' => 'secure@example.com',
            'password' => 'WrongPassword123!',
        ]);

        $response->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_secure_login_is_limited_after_three_attempts(): void
    {
        for ($attempt = 1; $attempt <= 3; $attempt++) {
            $this->post(route('login.secure'), [
                'email' => 'attacker@example.com',
                'password' => 'WrongPassword123!',
            ]);
        }

        $response = $this->post(route('login.secure'), [
            'email' => 'attacker@example.com',
            'password' => 'WrongPassword123!',
        ]);

        $response->assertStatus(429);
    }

    public function test_authenticated_user_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->post(route('logout'));

        $response->assertRedirect(route('home'));

        $this->assertGuest();
    }
}
