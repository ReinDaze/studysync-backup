<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginKeGayaBelajarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pengguna_dapat_login_dan_mengakses_halaman_tes_gaya_belajar()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');

        $this->actingAs($user)
             ->get('/tes-gaya-belajar')
             ->assertStatus(200)
             ->assertSee(''); 
    }
}
