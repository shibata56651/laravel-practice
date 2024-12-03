<?php

namespace Tests\Feature\Auth;

use App\Models\Admin;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use Tests\UsedbTestCase;

class PasswordResetTest extends UsedbTestCase
{
    public function test_reset_password_link_screen_can_be_rendered(): void
    {
        $response = $this->get('/forgot-password');

        $response->assertStatus(200);
    }

    public function test_reset_password_link_can_be_requested(): void
    {
        Notification::fake();

        $admin = Admin::factory()->create();

        $this->post('/forgot-password', ['email' => $admin->email]);

        Notification::assertSentTo($admin, ResetPassword::class);
    }

    public function test_reset_password_screen_can_be_rendered(): void
    {
        Notification::fake();

        $admin = Admin::factory()->create();

        $this->post('/forgot-password', ['email' => $admin->email]);

        Notification::assertSentTo($admin, ResetPassword::class, function ($notification) {
            $response = $this->get('/reset-password/' . $notification->token);

            $response->assertStatus(200);

            return true;
        });
    }

    public function test_password_can_be_reset_with_valid_token(): void
    {
        Notification::fake();

        $admin = Admin::factory()->create();

        $this->post('/forgot-password', ['email' => $admin->email]);

        Notification::assertSentTo($admin, ResetPassword::class, function ($notification) use ($admin) {
            $response = $this->post('/reset-password', [
                'token' => $notification->token,
                'email' => $admin->email,
                'password' => 'password',
                'password_confirmation' => 'password',
            ]);

            $response
                ->assertSessionHasNoErrors()
                ->assertRedirect(route('login'));

            return true;
        });
    }
}
