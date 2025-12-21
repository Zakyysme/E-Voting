<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Election;

class PemilihanController extends Controller
{
    public function index()
    {
        // Mengambil semua pemilihan yang statusnya aktif
        $elections = Election::where('status', 'running')->get();
        return view('landing.pemilihan.index', compact('elections'));
    }

    public function show($id)
    {
        // Mengambil detail pemilihan beserta kandidatnya
        $election = Election::with('candidates')->findOrFail($id);
        return view('landing.pemilihan.show', compact('election'));
    }

    
}
