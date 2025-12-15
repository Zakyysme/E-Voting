<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 1. Tambahkan Import Auth Facade
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // Tampilkan Halaman Profile
    public function edit()
    {
        return view('admin.pages.profile.edit', [
            'user' => Auth::user() // 2. Ganti auth()->user() menjadi Auth::user()
        ]);
    }

    // Update Data Diri (Nama, Email, Foto)
    public function update(Request $request)
    {
        // Ambil user yang sedang login menggunakan Auth Facade
        /** @var \App\Models\User $user */
        $user = Auth::user(); 

        $request->validate([
            'name'  => 'required|string|max:255',
            // Perbaikan syntax unique agar lebih aman
            'email' => 'required|email|unique:users,email,' . $user->id,
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        // Logic Upload Foto
        if ($request->hasFile('foto')) {
    // 1. Hapus foto lama (Gunakan disk 'public')
    if ($user->foto && Storage::disk('public')->exists('photos/' . $user->foto)) {
        Storage::disk('public')->delete('photos/' . $user->foto);
    }
    
    // 2. Simpan foto baru
    // Parameter ke-3 'public' memastikan file masuk ke storage/app/public/photos
    $filename = time() . '.' . $request->file('foto')->extension();
    $request->file('foto')->storeAs('photos', $filename, 'public'); 

    // Simpan HANYA nama filenya ke database
    $user->foto = $filename;
}

        $user->name = $request->name;
        $user->email = $request->email;
        
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // Update Password
    // Update Password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|current_password',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Ganti cara update agar tidak error 'Undefined method update'
        // Cara ini sama dengan yang Anda lakukan di function update() di atas
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah!');
    }
}