<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman edit profil.
     *
     * @return \Inertia\Response
     */
    public function edit()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        
        // Kirim data user ke Inertia
        return Inertia::render('Profile/Edit', [
            'user' => $user,
        ]);
    }

    /**
     * Memperbarui data profil pengguna.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function update(Request $request)
{

     // Ambil data user yang sedang login
     $user = Auth::user();
     
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
        'birthdate' => 'nullable|date',
        'school_origin' => 'nullable|string|max:255',
    ]);


    // Update data pengguna
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'phone' => $request->phone,
        'birthdate' => $request->birthdate,
        'school_origin' => $request->school_origin,
    ]);

    $user->setAgeCategoryAttribute($request->birthdate);

    $user->save();

    // Kembalikan response untuk memberitahu bahwa profil telah diperbarui
    return Inertia::render('Profile/Edit', [
        'user' => $user,
        'status' => 'Profile updated successfully!',
    ]);
}

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        // Log out the user after deleting their account
        Auth::logout();

        // Redirect ke halaman utama atau login page setelah menghapus akun
        return redirect()->route('login')->with('status', 'Your account has been deleted successfully.');
    }

}
