<?php

namespace App\Http\Controllers; // Pastikan namespace di Admin

use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use App\Services\AuditLogger;

class ElectionController extends Controller
{
    // Menampilkan daftar pemilihan
    public function index()
    {
        $elections = Election::withCount('candidates')->latest()->get();
        return view('admin.pages.elections.index', compact('elections'));
    }

    // Form Tambah
    public function create()
    {
        return view('admin.pages.elections.create');
    }

    // Simpan Data
    public function store(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_at'    => 'required|date',
        'end_at'      => 'required|date|after:start_at',
    ]);

    $election = Election::create([
            'title'       => $request->title,
            'description' => $request->description,
            'start_at'    => $request->start_at,
            'end_at'      => $request->end_at,
            'created_by'  => $request->user()->id, 
            'status'      => 'draft',
        ]);

    return redirect()->route('admin.elections.index')
        ->with('success', 'Agenda Pemilihan berhasil dibuat!');
}

    // Lihat Detail
    public function show(Election $election)
    {
        // Load kandidat yang terkait dengan election ini
        $election->load('candidates');
        return view('admin.pages.elections.show', compact('election'));
    }

    // Form Edit
    public function edit(Election $election)
    {
        return view('admin.pages.elections.edit', compact('election'));
    }

    // Update Data
    public function update(Request $request, Election $election)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_at'    => 'required|date',
            'end_at'      => 'required|date',
            'status'      => 'required|in:draft,running,finished'
        ]);

        $election->update($request->all());

        return redirect()->route('admin.elections.index')
            ->with('success', 'Data pemilihan diperbarui!');
    }

    // Hapus Data
    public function destroy(Election $election)
    {
        $election->delete();
        return redirect()->route('admin.elections.index')
            ->with('success', 'Data pemilihan dihapus.');
    }
}