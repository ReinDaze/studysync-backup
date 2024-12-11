<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /** @test */
    public function memvalidasi_field_username_dan_password(): void
    {
        // Uji tanpa mengisi field
        $response = $this->post('/login', []);

        $response->assertSessionHasErrors(['email', 'password']);

        // Uji dengan email tidak valid
        $response = $this->post('/login', [
            'email' => 'email-tidak-valid',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function memastikan_password_terenkripsi_di_database(): void
    {
        $password = 'password123';

        // Buat pengguna dengan password yang sudah dienkripsi
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        // Pastikan password yang tersimpan adalah hash, bukan plaintext
        $this->assertTrue(Hash::check($password, $user->password));
        $this->assertNotEquals($password, $user->password);
    }

    /** @test */
    public function menangani_kegagalan_login_dengan_benar(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Login dengan password yang salah
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password-salah',
        ]);

        // Pastikan pengguna tetap sebagai guest dan terdapat error pada session
        $this->assertGuest();
        $response->assertSessionHasErrors('email'); // Laravel menampilkan error pada field email saat login gagal
    }

    /** @test */
    public function mengelola_session_dengan_benar_saat_login_dan_logout(): void
    {
        // Buat pengguna admin untuk pengujian
        $admin = User::factory()->create(['role' => 'admin', 'password' => Hash::make('password123')]);

        // Buat pengguna biasa untuk pengujian
        $user = User::factory()->create(['role' => 'user', 'password' => Hash::make('password123')]);

        // Uji login sebagai admin
        $response = $this->post('/login', [
            'email' => $admin->email,
            'password' => 'password123',
        ]);

        // Pastikan admin terautentikasi dan diarahkan ke dashboard
        $this->assertAuthenticatedAs($admin);
        $response->assertRedirect(route('dashboard')); // Sesuaikan dengan nama route dashboard di aplikasi Anda

        // Logout setelah login sebagai admin
        $this->post('/logout');

        // Uji login sebagai pengguna biasa
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Pastikan pengguna biasa terautentikasi dan diarahkan ke home
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('home')); // Sesuaikan dengan nama route home di aplikasi Anda

        // Logout
        $this->post('/logout');

        // Pastikan pengguna sudah logout dan tidak terautentikasi lagi
        $this->assertGuest(); // Cek bahwa user sekarang adalah guest
    }

    /** @test */
    public function login_menggunakan_username_dan_password_yang_valid(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Login dengan kredensial yang valid
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Pastikan pengguna terautentikasi dan diarahkan ke halaman yang sesuai
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('home')); // Atau sesuai route tujuan user
    }

    /** @test */
    public function login_dengan_username_atau_password_kosong(): void
    {
        // Uji dengan field kosong
        $response = $this->post('/login', [
            'email' => '',
            'password' => '',
        ]);

        // Pastikan error muncul di session
        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function login_dengan_username_atau_password_yang_salah(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('password123'),
        ]);

        // Login dengan username atau password yang salah
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password-salah',
        ]);

        // Pastikan error muncul dan pengguna tetap sebagai guest
        $this->assertGuest();
        $response->assertSessionHasErrors('email'); // Atau 'password' tergantung error yang ditampilkan
    }
}
