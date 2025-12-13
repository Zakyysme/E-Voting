<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

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
        $election->load(['candidates' => function($query) {
            $query->withCount('votes'); // Menghasilkan property 'votes_count'
        }]);

        // Total suara masuk untuk persentase
        $totalVotes = $election->candidates->sum('votes_count');

        // Siapkan data untuk Chart.js
        $chartLabels = $election->candidates->pluck('name');
        $chartData   = $election->candidates->pluck('votes_count');

        return view('admin.pages.votes.show', compact('election', 'totalVotes', 'chartLabels', 'chartData'));
    }
    public function cast(Request $request, Election $election)
    {
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id'
        ]);

        $candidate = $election->candidates()->find($request->candidate_id);

        if (!$candidate) {
            return response()->json(['message' => 'Invalid candidate'], 422);
        }

        $now = now();
        if (!($election->start_at <= $now && $now <= $election->end_at)) {
            return response()->json(['message' => 'Voting not active'], 422);
        }

        try {
            $vote = DB::transaction(function () use ($request, $candidate, $election) {

                $receipt = hash('sha256',
                    $request->user()->id . '|' .
                    $candidate->id . '|' .
                    Str::random(40) . '|' .
                    now()
                );

                return Vote::create([
                    'user_id'      => $request->user()->id,
                    'election_id'  => $election->id,
                    'candidate_id' => $candidate->id,
                    'receipt_hash' => $receipt,
                    'casted_at'    => now()
                ]);
            });

            return response()->json([
                'message' => 'Vote submitted',
                'receipt' => $vote->receipt_hash
            ], 201);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'You already voted in this election'
            ], 409);
        }
    }

    public function results(Election $election)
    {
        $results = $election->candidates()->withCount('votes')->get();

        return response()->json($results);
    }
}
