<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Soal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoalTest extends TestCase
{
    use RefreshDatabase;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Buat pengguna admin untuk autentikasi
        $this->admin = User::factory()->create(['role' => 'admin']); // Pastikan ada kolom 'role'
    }

    /** @test */
    public function dapat_membuat_soal_baru()
    {
        $this->actingAs($this->admin);

        $response = $this->post(route('soal.store'), [
            'soal' => 'Apa itu Vue?',
            'jawaban_1' => 'Framework',
            'gaya_belajar_1' => 'Visual',
            'jawaban_2' => 'Bahasa Pemrograman',
            'gaya_belajar_2' => 'Auditori',
            'jawaban_3' => 'Library',
            'gaya_belajar_3' => 'Kinestetik',
        ]);

        $response->assertStatus(302); // Redirect setelah berhasil
        $this->assertDatabaseHas('soals', ['soal' => 'Apa itu Vue?']);
    }

    /** @test */
    public function menambah_soal_dengan_data_kosong_atau_tidak_valid()
    {
        $this->actingAs($this->admin);

        // Mengirimkan soal dengan data yang kosong
        $response = $this->post(route('soal.store'), []);

        // Pastikan ada error di form
        $response->assertSessionHasErrors(['soal', 'jawaban_1', 'gaya_belajar_1']);

        // Mengirimkan soal dengan data yang tidak valid
        $response = $this->post(route('soal.store'), [
            'soal' => '',
            'jawaban_1' => 'Framework',
            'gaya_belajar_1' => 'Visual',
        ]);

        // Pastikan ada error karena soal kosong
        $response->assertSessionHasErrors('soal');
    }

    /** @test */
    public function dapat_mengedit_soal()
    {
        $this->actingAs($this->admin);

        $soal = Soal::factory()->create([
            'soal' => 'Apa itu Laravel?',
            'jawaban_1' => 'Framework PHP',
            'gaya_belajar_1' => 'Visual',
        ]);

        $response = $this->put(route('soal.update', $soal->id), [
            'soal' => 'Apa itu Laravel Framework?',
            'jawaban_1' => 'Framework PHP Modern',
            'gaya_belajar_1' => 'Auditori',
            'jawaban_2' => 'Framework Lama',
            'gaya_belajar_2' => 'Kinestetik',
            'jawaban_3' => 'Framework untuk Java',
            'gaya_belajar_3' => 'Visual',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('soals', ['soal' => 'Apa itu Laravel Framework?']);
    }

    /** @test */
    public function dapat_menampilkan_soal_yang_sudah_dibuat()
    {
        $this->actingAs($this->admin);

        // Buat soal untuk memastikan ada data yang dikirim
        Soal::factory()->count(5)->create();

        // Memastikan response berisi data 'soals'
        $response = $this->get(route('dashboard'));

        $response->assertStatus(200);

        // Verifikasi bahwa data 'soals' tersedia di Inertia response
        $response->assertInertia(fn($inertia) => $inertia->has('soals'));
    }

    /** @test */
    public function dapat_menghapus_soal()
    {
        $this->actingAs($this->admin);

        $soal = Soal::factory()->create();

        $response = $this->delete(route('soal.destroy', $soal->id));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('soals', ['id' => $soal->id]);
    }
}
