<?php

namespace Tests\Feature\Auth;

use App\Models\Admin;
use Tests\UsedbTestCase;

class PasswordConfirmationTest extends UsedbTestCase
{
    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin)->get('/confirm-password');

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin)->post('/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
