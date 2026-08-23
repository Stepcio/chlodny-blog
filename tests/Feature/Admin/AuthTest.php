<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login_from_admin_area(): void
    {
        $response = $this->get(route('admin.shops.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_can_log_in_with_correct_credentials(): void
    {
        $user = User::factory()->create(['password' => 'correct-password']);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'correct-password',
        ]);

        $response->assertRedirect(route('admin.shops.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_log_in_with_wrong_password(): void
    {
        $user = User::factory()->create(['password' => 'correct-password']);

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_authenticated_user_can_log_out(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('logout'));

        $response->assertRedirect(route('home'));
        $this->assertGuest();
    }
}
