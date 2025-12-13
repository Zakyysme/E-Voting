<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User; // Menggunakan model User bawaan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class VoterController extends Controller
{
    // Tampilkan daftar pemilih
    public function index()
    {
        // Ambil user yang role-nya 'voter', urutkan terbaru, dan pagination
        // Pastikan di database tabel users ada kolom 'role'
        $voters = User::where('role', 'voter')->latest()->paginate(10);
        
        return view('admin.pages.voters.index', compact('voters'));
    }

    // Form tambah pemilih
    public function create()
    {
        return view('admin.pages.voters.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'voter', // Set otomatis sebagai voter
        ]);

        return redirect()->route('admin.voters.index')->with('success', 'Data pemilih berhasil ditambahkan.');
    }

    // Form edit
    public function edit($id)
    {
        // Cari user berdasarkan ID dan pastikan dia adalah voter
        $voter = User::where('role', 'voter')->findOrFail($id);
        return view('admin.pages.voters.edit', compact('voter'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $voter = User::where('role', 'voter')->findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($voter->id)],
            'password' => 'nullable|string|min:6', // Password boleh kosong jika tidak ingin diganti
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
        ];

        // Jika password diisi, update password baru. Jika kosong, biarkan yang lama.
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $voter->update($data);

        return redirect()->route('admin.voters.index')->with('success', 'Data pemilih diperbarui.');
    }

    // Hapus data
    public function destroy($id)
    {
        $voter = User::where('role', 'voter')->findOrFail($id);
        $voter->delete();

        return redirect()->route('admin.voters.index')->with('success', 'Data pemilih dihapus.');
    }
}