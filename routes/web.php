<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Models\HasilGayaBelajar;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SoalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


Route::get('/', function () {
    return Inertia::render('HomeView', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::middleware(['auth'])->get('/dashboard-user', function () {
    $user = auth()->user(); // Mengambil data pengguna yang sedang login
    $learningHistory = HasilGayaBelajar::where('user_id', $user->id)->latest()->get(); // Riwayat gaya belajar berdasarkan user_id

    // Tips untuk masing-masing gaya belajar
    $learningTips = [
        'Visual' => 'Gunakan alat bantu visual seperti gambar, diagram, atau grafik untuk mempermudah pemahaman materi.',
        'Auditori' => 'Cobalah belajar dengan mendengarkan rekaman atau menjelaskan materi pada orang lain untuk memperdalam pemahaman.',
        'Kinestetik' => 'Praktikkan langsung materi dengan membuat simulasi atau percakapan fisik agar lebih mudah mengingat informasi.',
    ];

    return Inertia::render('DashboardUser', [
        'user' => $user,
        'learningHistory' => $learningHistory,
        'learningTips' => $learningTips, // Menyertakan tips berdasarkan gaya belajar
    ]);
})->name('dashboarduser');

Route::get('/bantuan', function () {
    return Inertia::render('BantuanView');
})->name('bantuan');

Route::get('/kontak', function () {
    return Inertia::render('KontakView');
})->name('kontak');

Route::get('/login', function () {
    return Inertia::render('LoginView');
})->name('login');

// routes/web.php


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [SoalController::class, 'index'])->name('dashboard');
    Route::get('/tes-gaya-belajar', [SoalController::class, 'tesGayaBelajar'])->name('tes-gaya-belajar');
    Route::get('/soal/add', [SoalController::class, 'create'])->name('soal.create');
    Route::post('/soal', [SoalController::class, 'store'])->name('soal.store');
    Route::get('/soal/{soal}/edit', [SoalController::class, 'edit'])->name('soal.edit');
    Route::put('/soal/{soal}', [SoalController::class, 'update'])->name('soal.update');
    Route::delete('/soal/{id}', [SoalController::class, 'destroy'])->name('soal.destroy');

    // Submit Kuisioner
    Route::post('/submit-kuisioner', [SoalController::class, 'submitKuisioner'])->name('kuisioner.submit');


    // Hasil Kuisioner
    Route::get('/hasil-kuisioner', function () {
        return Inertia::render('HasilView', [
            'results' => Session::get('results', []),
            'dominantStyles' => Session::get('dominantStyles', []),
            'description' => Session::get('description', ''),
        ]);
    })->name('hasil.kuisioner');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-test', [RiwayatController::class, 'index'])->name('riwayat.test.index');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
