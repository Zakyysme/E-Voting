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
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', 
        ]);

        // Logic Upload Foto
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::exists('public/photos/' . $user->photo)) {
                Storage::delete('public/photos/' . $user->photo);
            }
            
            // Simpan foto baru
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->storeAs('public/photos', $filename);
            $user->photo = $filename;
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