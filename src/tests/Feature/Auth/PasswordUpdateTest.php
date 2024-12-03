<?php

namespace Tests\Feature\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Tests\UsedbTestCase;

class PasswordUpdateTest extends UsedbTestCase
{
    public function test_password_can_be_updated(): void
    {
        $admin = Admin::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->from('/profile')
            ->put('/password', [
                'current_password' => 'password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/profile');

        $this->assertTrue(Hash::check('new-password', $admin->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $admin = Admin::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->from('/profile')
            ->put('/password', [
                'current_password' => 'wrong-password',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response
            ->assertSessionHasErrorsIn('updatePassword', 'current_password')
            ->assertRedirect('/profile');
    }
}
