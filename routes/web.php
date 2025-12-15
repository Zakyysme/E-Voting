<?php

use Illuminate\Support\Facades\Route;

// Import Controller Auth
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Import Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BoothController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ProfileController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect halaman awal ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ====================================================
// 1. AUTHENTICATION ROUTES (Login & Logout)
// ====================================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.process');
});

// Logout harus bisa diakses oleh user yang sudah login (POST method)
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


// ====================================================
// 2. ADMIN ROUTES
// ====================================================
// Middleware 'auth' memastikan user sudah login.
// Prefix 'admin' membuat URL jadi /admin/dashboard, /admin/elections, dll.
// Name 'admin.' membuat pemanggilan route jadi route('admin.dashboard').

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // A. Dashboard
    // URL: /admin/dashboard | Route Name: admin.dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // B. Data Master (Resource Controller)
    // Ini otomatis membuat route index, create, store, edit, update, destroy
    
    // 1. Elections (Periode Pemilihan)
    // Route Name: admin.elections.index, admin.elections.create, dst.
    Route::resource('elections', ElectionController::class);

    // 2. Candidates (Kandidat)
    // Route Name: admin.candidates.index, dst.
    Route::resource('candidates', CandidateController::class);

    // 3. Voters (Daftar Pemilih Tetap)
    // Route Name: admin.voters.index, dst.
    Route::resource('voters', VoterController::class);

    // C. Laporan & Audit
    
    // 1. Real Count / Hasil Voting
    // URL: /admin/votes
    Route::get('/votes', [VoteController::class, 'index'])->name('votes.index');
    // URL: /admin/votes/{election} (Detail grafik per pemilihan)
    Route::get('/votes/{election}', [VoteController::class, 'show'])->name('votes.show');

    // 1. Menampilkan halaman daftar bilik
    Route::get('/booths', [BoothController::class, 'index'])->name('booths.index');

    // 2. Menyimpan bilik baru
    Route::post('/booths', [BoothController::class, 'store'])->name('booths.store');

    // 3. Menghapus bilik
    Route::delete('/booths/{booth}', [BoothController::class, 'destroy'])->name('booths.destroy');

    // 4. Reset Kode Akses (Acak Ulang)
    Route::patch('/booths/{id}/reset', [BoothController::class, 'resetCode'])->name('booths.reset');

    // 5. Ganti Status (Aktif/Nonaktif)
    Route::patch('/booths/{id}/toggle', [BoothController::class, 'toggleStatus'])->name('booths.toggle');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});