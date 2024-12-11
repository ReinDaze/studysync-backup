<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\HasilGayaBelajar;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SoalController extends Controller
{
    // Menampilkan daftar soal di dashboard
    public function index()
    {
        // Ambil semua soal dan tampilkan di dashboard
        $soals = Soal::all();
        return Inertia::render('Dashboard', [
            'soals' => $soals,
        ]);
    }

    

    public function tesGayaBelajar()
    {
        // Ambil semua soal dan hanya kirimkan data soal dan jawaban (tanpa gaya belajar)
        $soals = Soal::all()->map(function ($soal) {
            return [
                'id' => $soal->id,
                'soal' => $soal->soal,
                'jawaban_options' => [
                    $soal->jawaban_1,
                    $soal->jawaban_2,
                    $soal->jawaban_3,
                ]
            ];
        });

        return Inertia::render('TesGayaBelajarView', [
            'soals' => $soals,
        ]);
    }

    // Menampilkan form untuk membuat soal baru
    public function create()
    {
        return Inertia::render('Soals/AddSoal');
    }

    // Menyimpan soal baru
    public function store(Request $request)
    {
        // Validasi input soal dan jawaban
        $validated = $request->validate([
            'soal' => 'required|string|max:255',
            'jawaban_1' => 'required|string|max:255',
            'jawaban_2' => 'required|string|max:255',
            'jawaban_3' => 'required|string|max:255',
            'gaya_belajar_1' => 'required|in:Kinestetik,Visual,Auditori',
            'gaya_belajar_2' => 'required|in:Kinestetik,Visual,Auditori',
            'gaya_belajar_3' => 'required|in:Kinestetik,Visual,Auditori',
            'nilai_jawaban_1' => 'required|integer|min:0',
            'nilai_jawaban_2' => 'required|integer|min:0',
            'nilai_jawaban_3' => 'required|integer|min:0',
        ]);

        // Menyimpan soal baru ke dalam database
        Soal::create($validated);

        // Kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Soal berhasil ditambahkan!');
    }

    // Menampilkan form edit soal
    public function edit(Soal $soal)
    {
        return Inertia::render('Soals/EditSoal', [
            'soal' => $soal,
        ]);
    }

    // Mengupdate soal
    public function update(Request $request, Soal $soal)
    {
        // Validasi input soal dan jawaban
        $validated = $request->validate([
            'soal' => 'required|string|max:255',
            'jawaban_1' => 'required|string|max:255',
            'jawaban_2' => 'required|string|max:255',
            'jawaban_3' => 'required|string|max:255',
            'gaya_belajar_1' => 'required|in:Kinestetik,Visual,Auditori',
            'gaya_belajar_2' => 'required|in:Kinestetik,Visual,Auditori',
            'gaya_belajar_3' => 'required|in:Kinestetik,Visual,Auditori',
            'nilai_jawaban_1' => 'required|integer|min:0',
            'nilai_jawaban_2' => 'required|integer|min:0',
            'nilai_jawaban_3' => 'required|integer|min:0',
        ]);

        // Mengupdate soal dengan data yang sudah divalidasi
        $soal->update($validated);

        // Kembali ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Soal berhasil diupdate!');
    }

    // Menghapus soal
    public function destroy($id)
    {
        try {
            // Cari soal berdasarkan ID
            $soal = Soal::findOrFail($id);

            // Hapus soal dari database
            $soal->delete();

            // Kembali ke index soal dengan pesan sukses
            return redirect()->route('dashboard')->with('success', 'Soal berhasil dihapus!');
        } catch (\Exception $e) {
            // Pesan kesalahan jika terjadi masalah
            return redirect()->route('dashboard')->with('error', 'Terjadi kesalahan saat menghapus soal!');
        }
    }

    public function submitKuisioner(Request $request)
{
    $request->validate([
        'jawaban' => 'required|array',
    ]);

    // Hitung skor gaya belajar
    $scores = ['Visual' => 0, 'Auditori' => 0, 'Kinestetik' => 0];
    foreach ($request->jawaban as $soalId => $jawaban) {
        $soal = Soal::findOrFail($soalId);

        if ($jawaban == 'jawaban_1') {
            $scores[$soal->gaya_belajar_1] += $soal->nilai_jawaban_1;
        } elseif ($jawaban == 'jawaban_2') {
            $scores[$soal->gaya_belajar_2] += $soal->nilai_jawaban_2;
        } elseif ($jawaban == 'jawaban_3') {
            $scores[$soal->gaya_belajar_3] += $soal->nilai_jawaban_3;
        }
    }

    $totalScore = array_sum($scores);
    $results = [
        'Visual' => $totalScore ? round(($scores['Visual'] / $totalScore) * 100) : 0,
        'Auditori' => $totalScore ? round(($scores['Auditori'] / $totalScore) * 100) : 0,
        'Kinestetik' => $totalScore ? round(($scores['Kinestetik'] / $totalScore) * 100) : 0,
    ];


    // Tentukan gaya belajar dominan (semua yang memiliki persentase tertinggi)
    $maxPercentage = max($results); // Cari persentase tertinggi
    $dominantStyles = array_keys($results, $maxPercentage); // Ambil semua gaya belajar dengan persentase tertinggi

    // Tambahkan gaya dengan perbedaan <= 5% dari tertinggi
    foreach ($results as $style => $percentage) {
        if (!in_array($style, $dominantStyles) && ($maxPercentage - $percentage) <= 7) {
            $dominantStyles[] = $style;
        }
    }

    // Deskripsi untuk setiap gaya belajar dominan
    $descriptions = [
        'Visual' => 'Seseorang dengan gaya belajar visual mengandalkan penglihatan sebagai cara utama untuk memahami informasi.',
        'Auditori' => 'Seseorang dengan gaya belajar auditori lebih mengandalkan pendengaran untuk memahami informasi.',
        'Kinestetik' => 'Seseorang dengan gaya belajar kinestetik lebih suka belajar melalui gerakan fisik atau pengalaman langsung.',
    ];

    $description = implode(' ', array_map(fn($style) => $descriptions[$style], $dominantStyles));

    // Simpan hasil ke database
    HasilGayaBelajar::create([
        'user_id' => auth()->id(),
        'dominant_style' => implode(', ', $dominantStyles), // Gabungkan gaya belajar dominan
        'description' => $description, // Gabungkan deskripsi
        'visual_score' => $results['Visual'],
        'auditori_score' => $results['Auditori'],
        'kinestetik_score' => $results['Kinestetik'],
    ]);

    // Simpan hasil ke session
    Session::put('results', $results);
    Session::put('dominantStyles', $dominantStyles);
    Session::put('description', $description);

    // Redirect ke halaman hasil
    return redirect()->route('hasil.kuisioner');
}




}
