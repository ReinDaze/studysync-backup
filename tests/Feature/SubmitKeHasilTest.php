<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Soal;
use App\Models\HasilGayaBelajar;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubmitKeHasilTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_dapat_submit_tes_dan_mendapatkan_hasil_tes()
    {
        // Step 1: Setup Data
        $user = User::factory()->create();
        $soal = Soal::factory()->count(3)->create(); // Buat 3 soal
        $this->actingAs($user);

        // Step 2: Submit Quiz
        $response = $this->post('/submit-kuisioner', [
            'jawaban' => [
                $soal[0]->id => 'jawaban_1',
                $soal[1]->id => 'jawaban_2',
                $soal[2]->id => 'jawaban_3',
            ],
        ]);

        $response->assertRedirect('/hasil-kuisioner');

        // Step 3: Verify Results
        $this->assertDatabaseHas('hasil_gaya_belajar', [
            'user_id' => $user->id,
        ]);

        $hasil = HasilGayaBelajar::first();
        $this->assertNotNull($hasil->dominant_style); // Pastikan gaya belajar disimpan
    }
}
