<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
        return view("admin.auth.register");
    }
   public function register(Request $request)
    {
        // 1. Validasi Data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 2. Buat dan Simpan Pengguna
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password sebelum disimpan
            'role' => 'voter',
        ]);

        // 3. Login Otomatis setelah Registrasi
        Auth::login($user);

        // 4. Redirect ke Halaman Utama
        if ($user->role === 'admin'){
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('index')->with('success', 'Pendaftaran Berhasil!');
    } 
}
