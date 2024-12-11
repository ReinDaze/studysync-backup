<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'New User',
            'email' => 'newuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Pastikan pengalihan setelah registrasi sesuai dengan pengaturan Laravel Breeze
        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', [
            'email' => 'newuser@example.com',
        ]);
    }

    public function test_user_can_view_profile(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/profile');

        $response->assertOk();
        $response->assertInertia(fn ($page) =>
            $page->component('Profile/Edit')
                 ->where('user.id', $user->id)
        );
    }

    public function test_user_can_update_profile(): void
    {
        $user = User::factory()->create();

        $updatedData = [
            'name' => 'Updated User',
            'email' => 'updateduser@example.com',
            'address' => 'Updated Address',
            'phone' => '9876543210',
            'birthdate' => '1991-02-02',
        ];

        $response = $this
            ->actingAs($user)
            ->patch('/profile', $updatedData);

        $response
            ->assertSessionHasNoErrors(201)
            ->assertRedirect('/profile');

        $user->refresh();

        $this->assertSame('Updated User', $user->name);
        $this->assertSame('updateduser@example.com', $user->email);
        $this->assertSame('Updated Address', $user->address);
        $this->assertSame('9876543210', $user->phone);
        $this->assertSame('1991-02-02', $user->birthdate);
    }

    public function test_user_can_delete_account(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        // Verifikasi dengan kata sandi yang benar
        $response = $this
            ->actingAs($user)
            ->delete('/profile', [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/login')
            ->assertSessionHas('status', 'Your account has been deleted successfully.');

        // Pastikan pengguna telah logout dan akun terhapus
        $this->assertGuest();
        $this->assertNull($user->fresh());
    }

    public function test_user_cannot_delete_account_with_incorrect_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        // Uji penghapusan dengan kata sandi yang salah
        $response = $this
            ->actingAs($user)
            ->from('/profile')
            ->delete('/profile', [
                'password' => 'wrong-password',
            ]);

        $response
            ->assertSessionHasErrors('wrong-password')
            ->assertRedirect('/profile');

        // Pastikan akun masih ada karena password salah
        $this->assertNotNull($user->fresh());
    }
}
