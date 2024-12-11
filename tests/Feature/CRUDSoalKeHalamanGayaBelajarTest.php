<?php

namespace Tests\Feature;

use App\Models\Soal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CRUDSoalKeHalamanGayaBelajarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test menambah soal baru dan memastikan soal muncul di halaman tes gaya belajar.
     */
    public function test_membuat_soal_dan_melihat_di_halaman_tes_gaya_belajar()
    {
        // Step 1: Login sebagai admin
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Step 2: Tambah soal baru
        $soalData = [
            'soal' => 'Apa warna favorit Anda?',
            'jawaban_1' => 'Merah',
            'gaya_belajar_1' => 'Visual',
            'nilai_jawaban_1' => 10,
            'jawaban_2' => 'Biru',
            'gaya_belajar_2' => 'Auditori',
            'nilai_jawaban_2' => 20,
            'jawaban_3' => 'Hijau',
            'gaya_belajar_3' => 'Kinestetik',
            'nilai_jawaban_3' => 15,
        ];

        $response = $this->post(route('soal.store'), $soalData);
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('soals', ['soal' => 'Apa warna favorit Anda?']);

        // Step 3: Akses halaman tes gaya belajar
        $response = $this->get('/tes-gaya-belajar');
        $response->assertStatus(200)
                 ->assertSee('Apa warna favorit Anda?');
    }

    /**
     * Test mengedit soal dan memastikan perubahan muncul di halaman tes gaya belajar.
     */
    public function test_edit_soal_dan_melihat_update_soal_di_tes_gaya_belajar()
    {
        // Step 1: Login sebagai admin
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Step 2: Tambah soal awal
        $soal = Soal::factory()->create([
            'soal' => 'Apa warna favorit Anda?',
        ]);

        // Step 3: Edit soal
        $updatedData = [
            'soal' => 'Apa hobi Anda?',
            'jawaban_1' => $soal->jawaban_1,
            'gaya_belajar_1' => $soal->gaya_belajar_1,
            'nilai_jawaban_1' => $soal->nilai_jawaban_1,
            'jawaban_2' => $soal->jawaban_2,
            'gaya_belajar_2' => $soal->gaya_belajar_2,
            'nilai_jawaban_2' => $soal->nilai_jawaban_2,
            'jawaban_3' => $soal->jawaban_3,
            'gaya_belajar_3' => $soal->gaya_belajar_3,
            'nilai_jawaban_3' => $soal->nilai_jawaban_3,
        ];

        $response = $this->put(route('soal.update', $soal), $updatedData);
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('soals', ['soal' => 'Apa hobi Anda?']);

        // Step 4: Akses halaman tes gaya belajar
        $response = $this->get('/tes-gaya-belajar');
        $response->assertStatus(200)
                 ->assertSee('Apa hobi Anda?');
    }

    /**
     * Test menghapus soal dan memastikan soal tidak lagi muncul di halaman tes gaya belajar.
     */
    public function test_menghapus_soal_dan_memeriksa_apakah_soal_sudah_hilang_di_tes_gaya_belajar()
    {
        // Step 1: Login sebagai admin
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        // Step 2: Tambah soal awal
        $soal = Soal::factory()->create([
            'soal' => 'Apa warna favorit Anda?',
        ]);

        // Step 3: Hapus soal
        $response = $this->delete(route('soal.destroy', $soal));
        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('soals', ['soal' => 'Apa warna favorit Anda']);

        // Step 4: Akses halaman tes gaya belajar
        $response = $this->get('/tes-gaya-belajar');
        $response->assertStatus(200)
                 ->assertDontSee('Apa warna favorit Anda?');
    }
}
