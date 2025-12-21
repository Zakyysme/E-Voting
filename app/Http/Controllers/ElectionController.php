<?php

namespace App\Http\Controllers; // Pastikan namespace di Admin

use App\Http\Controllers\Controller;
use App\Models\Election;
use Illuminate\Http\Request;
use App\Models\AuditLog;
use App\Services\AuditLogger;
use Illuminate\Support\Facades\Storage;


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
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_at'    => 'required|date',
        'end_at'      => 'required|date|after:start_at',
        'logo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Simpan semua input ke dalam array $data
    $data = $request->all();
    $data['created_by'] = $request->user()->id;
    $data['status'] = 'draft';

    // Cek jika ada file logo
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('elections', 'public');
        $data['logo'] = $path; // Masukkan path ke array $data
    }

    // Gunakan $data untuk create
    Election::create($data);

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
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_at'    => 'required|date',
        'end_at'      => 'required|date',
        'status'      => 'required|in:draft,running,finished',
        'logo'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Ambil semua input teks
    $data = $request->all();

    if ($request->hasFile('logo')) {
        // Hapus logo lama jika ada
        if ($election->logo) {
            Storage::disk('public')->delete($election->logo);
        }
        // Simpan logo baru
        $path = $request->file('logo')->store('elections', 'public');
        $data['logo'] = $path;
    }

    // Update semua data (teks + logo baru jika ada)
    $election->update($data);

    return redirect()->route('admin.elections.index')
        ->with('success', 'Data pemilihan diperbarui!');
}

    // Hapus Data
    public function destroy(Election $election)
    {
        if ($election->logo) {
            Storage::disk('public')->delete($election->logo);
        }
        $election->delete();
        return redirect()->route('admin.elections.index')
            ->with('success', 'Data pemilihan dihapus.');
    }
}