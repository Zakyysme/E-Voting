<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        // Menampilkan daftar Election yang bisa dilihat hasilnya
        $elections = Election::latest()->get();
        return view('admin.pages.votes.index', compact('elections'));
    }

    public function show(Election $election)
    {
        // Eager load candidates beserta jumlah vote-nya
        // Asumsi: Anda punya relasi 'votes' di model Candidate (hasMany Vote)
        $election->load(['candidates' => function ($query) {
            $query->withCount('votes'); // Menghasilkan property 'votes_count'
        }]);

        // Total suara masuk untuk persentase
        $totalVotes = $election->candidates->sum('votes_count');

        // Siapkan data untuk Chart.js
        $chartLabels = $election->candidates->pluck('name');
        $chartData   = $election->candidates->pluck('votes_count');

        return view('admin.pages.votes.show', compact('election', 'totalVotes', 'chartLabels', 'chartData'));
    }
    public function store(Request $request, $electionId)
    {
        // 1. Validasi Input
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        $user = Auth::user();

        // 2. Cek Double Voting (Satu User Satu Suara per Pemilihan)
        // Kita cek apakah user_id dan election_id ini sudah ada di tabel votes
        $hasVoted = Vote::where('user_id', $user->id)
                        ->where('election_id', $electionId)
                        ->exists();

        if ($hasVoted) {
            return redirect()->back()->with('error', 'Anda sudah menggunakan hak pilih pada pemilihan ini.');
        }

        // 3. Proses Transaksi Database
        try {
            DB::beginTransaction();

            // Membuat Receipt Hash Unik (SHA256)
            // Menggabungkan ID User + ID Election + Timestamp saat ini
            $rawString = $user->id . '-' . $electionId . '-' . $request->candidate_id . '-' . time();
            $receiptHash = hash('sha256', $rawString);

            // Simpan ke Database sesuai Model Anda
            Vote::create([
                'user_id'      => $user->id,
                'election_id'  => $electionId,
                'candidate_id' => $request->candidate_id,
                'receipt_hash' => $receiptHash,
                'casted_at'    => now(), // Mengisi kolom casted_at sesuai model Anda
            ]);

            DB::commit();

            // 4. Redirect kembali dengan data 'receipt' untuk memicu Modal di Blade
            return redirect()->back()->with([
                'success' => 'Suara berhasil direkam!',
                'receipt' => $receiptHash 
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            // Log error jika perlu: \Log::error($e);
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem, silakan coba lagi.');
        }
    }

    public function result($electionId)
{
    // 1. Ambil data pemilihan
    $election = Election::findOrFail($electionId);

    // 2. Ambil kandidat beserta jumlah votenya KHUSUS di pemilihan ini
    // Kita urutkan berdasarkan suara terbanyak (descending)
    $candidates = \App\Models\Candidate::where('election_id', $electionId)
        ->withCount(['votes' => function ($query) use ($electionId) {
            $query->where('election_id', $electionId);
        }])
        ->orderBy('votes_count', 'desc')
        ->get();

    // 3. Hitung total seluruh suara masuk
    $totalVotes = $candidates->sum('votes_count');

    return view('landing.quickcount', compact('election', 'candidates', 'totalVotes'));
}
}
