<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. MENGHITUNG STATISTIK UTAMA (KARTU ATAS)
        
        // Total suara yang sudah masuk
        $totalVotes = Vote::count();

        // Total DPT (Asumsi role 'voter' atau 'student')
        // Sesuaikan 'role', 'voter' dengan struktur database Anda
        $totalVoters = User::where('role', 'voter')->count(); 

        // Total Kandidat yang bertarung
        $totalCandidates = Candidate::count();

        // Menghitung Partisipasi (Opsional jika ingin hitung di Controller)
        $participationRate = $totalVoters > 0 ? ($totalVotes / $totalVoters) * 100 : 0;


        // 2. MENGAMBIL DATA AKTIVITAS TERBARU (TABEL)
        // Menggunakan 'with' untuk Eager Loading agar query lebih cepat
        $recentActivities = Vote::with('user') 
                                ->latest() // Urutkan dari yang terbaru
                                ->take(5)  // Ambil 5 data saja
                                ->get();


        // 3. (OPSIONAL) DATA UNTUK GRAFIK REAL COUNT
        // Ini berguna jika Anda ingin menampilkan Chart.js di dashboard
        $chartData = Candidate::withCount('votes')->get();
        $candidateNames = $chartData->pluck('name'); // Label Grafik
        $voteCounts = $chartData->pluck('votes_count'); // Data Angka


        // 4. KIRIM DATA KE VIEW
        return view('admin.pages.dashboard', [
            'totalVotes'       => $totalVotes,
            'totalVoters'      => $totalVoters,
            'totalCandidates'  => $totalCandidates,
            'recentActivities' => $recentActivities,
            'participationRate'=> $participationRate,
            
            // Kirim data grafik jika diperlukan
            'chartLabels'      => $candidateNames,
            'chartValues'      => $voteCounts
        ]);
    }
}