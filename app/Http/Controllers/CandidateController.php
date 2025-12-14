<?php

namespace App\Http\Controllers; // Pastikan namespace ini benar (ada di folder Admin)

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Election; // Jangan lupa import model Election
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CandidateController extends Controller
{
    // Menampilkan daftar semua kandidat
    public function index()
    {
        // PERBAIKAN: Ambil semua kandidat beserta data election-nya (Eager Loading)
        // Bukan '$election->candidates' karena $election tidak didefinisikan di sini
        $candidates = Candidate::with('election')->latest()->get();
        
        // Pastikan nama folder view sesuai: resources/views/admin/candidates/index.blade.php
        return view('admin.pages.candidates.index', compact('candidates'));
    }

    // Menampilkan form tambah
    public function create()
    {
        // PERBAIKAN: Kita butuh daftar Election agar user bisa memilih kandidat ini untuk election yang mana
        $elections = Election::where('status', '!=', 'finished')->get(); 
        
        return view('admin.pages.candidates.create', compact('elections'));
    }

    // Menyimpan data
    public function store(Request $request)
    {
        $request->validate([
            // PERBAIKAN: Tambahkan validasi election_id
            'election_id' => 'required|exists:elections,id',
            'nomor_urut'  => [
                'required', 
                'integer', 
                Rule::unique('candidates')->where(function ($query) use ($request) {
                    return $query->where('election_id', $request->election_id);
                })
            ],
            'name'        => 'required|string|max:255', // Nama Ketua
        'vice_name'   => 'nullable|string|max:255', // Nama Wakil
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'vice_photo'  => 'nullable|image|max:2048', // Foto Wakil
        ]);

        $data = $request->all();

        // Handle Upload Foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('candidates', 'public');
            $data['photo_url'] = $path;
        }

        // 2. Upload Foto Wakil
    if ($request->hasFile('vice_photo')) {
        $data['vice_photo'] = $request->file('vice_photo')->store('candidates', 'public');
    }

        Candidate::create($data);

        // PERBAIKAN: Nama route biasanya 'admin.candidates.index' (tanpa 'pages')
        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat berhasil ditambahkan!');
    }

    // Menampilkan form edit
    public function edit(Candidate $candidate)
    {
        // Kirim juga data elections untuk jaga-jaga jika ingin memindahkan kandidat ke election lain
        $elections = Election::all();
        return view('admin.pages.candidates.edit', compact('candidate', 'elections'));
    }

    // Update data
    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'election_id' => 'sometimes|exists:elections,id', // Tambahan validasi
            'nomor_urut'  => [
                'required', 
                'integer', 
                Rule::unique('candidates')->ignore($candidate->id)->where(function ($query) use ($request) {
                    return $query->where('election_id', $request->election_id);
                })
            ],
            'name'        => 'required|string|max:255', // Nama Ketua
        'vice_name'   => 'nullable|string|max:255', // Nama Wakil
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'vice_photo'  => 'nullable|image|max:2048', // Foto Wakil
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($candidate->photo_url) {
                Storage::disk('public')->delete($candidate->photo_url);
            }
            $path = $request->file('photo')->store('candidates', 'public');
            $data['photo_url'] = $path;
        }

        if ($request->hasFile('vice_photo')) {
            if ($candidate->vice_photo) {
                Storage::disk('public')->delete($candidate->vice_photo);
            }
        $data['vice_photo'] = $request->file('vice_photo')->store('candidates', 'public');
    }

        $candidate->update($data);

        return redirect()->route('admin.candidates.index')->with('success', 'Data kandidat diperbarui!');
    }

    // Lihat Detail
    public function show(Candidate $candidate)
    {
        // Load relasi election agar kita tahu dia kandidat untuk pemilihan apa
        $candidate->load('election');
        return view('admin.pages.candidates.show', compact('candidate'));
    }

    // Hapus data
    public function destroy(Candidate $candidate)
    {
        if ($candidate->photo_url) {
            Storage::disk('public')->delete($candidate->photo_url);
        }
        if ($candidate->vice_photo) {
            Storage::disk('public')->delete($candidate->vice_photo);
        }
        
        $candidate->delete();

        return redirect()->route('admin.candidates.index')->with('success', 'Kandidat dihapus.');
    }
}