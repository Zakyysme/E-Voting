<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuditLogger;

class LoginController extends Controller
{
    public function index(){
        return view("admin.auth.login");
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
// dd($credentials);
        // 2. Coba Autentikasi
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Redirect ke dashboard admin
            return redirect()->route('admin.dashboard')
                ->with('success', 'Selamat datang kembali!');
        }

        // 3. Jika Autentikasi Gagal
        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
