<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VotingBooth; // Pastikan buat Model VotingBooth
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BoothController extends Controller
{
    public function index()
    {
        $booths = VotingBooth::latest()->get();
        return view('admin.pages.booths.index', compact('booths'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
        ]);

        VotingBooth::create([
            'name' => $request->name,
            'location' => $request->location,
            'access_code' => strtoupper(Str::random(6)), // Generate kode 6 digit
            'is_active' => true,
        ]);

        return back()->with('success', 'Bilik suara berhasil ditambahkan!');
    }

    public function destroy(VotingBooth $booth)
    {
        $booth->delete();
        return back()->with('success', 'Bilik dihapus.');
    }
    
    // Fitur Reset Kode (Penting untuk keamanan)
    public function resetCode($id)
    {
        $booth = VotingBooth::findOrFail($id);
        $booth->update(['access_code' => strtoupper(Str::random(6))]);
        return back()->with('success', 'Kode akses bilik berhasil di-reset!');
    }

    // Fitur Toggle Status (Aktif/Nonaktif)
    public function toggleStatus($id)
    {
        $booth = VotingBooth::findOrFail($id);
        $booth->update(['is_active' => !$booth->is_active]);
        return back()->with('success', 'Status bilik diperbarui.');
    }
}