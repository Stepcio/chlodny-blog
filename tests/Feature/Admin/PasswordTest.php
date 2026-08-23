<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_change_password(): void
    {
        $user = User::factory()->create(['password' => 'old-password']);

        $response = $this->actingAs($user)->put(route('admin.password.update'), [
            'current_password' => 'old-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertRedirect(route('admin.password.edit'));
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    public function test_password_update_requires_correct_current_password(): void
    {
        $user = User::factory()->create(['password' => 'old-password']);

        $response = $this->actingAs($user)->put(route('admin.password.update'), [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response->assertSessionHasErrors('current_password');
        $this->assertTrue(Hash::check('old-password', $user->fresh()->password));
    }
}
