@extends('admin.layouts.main')

@section('title', 'Daftar Kandidat')

@section('content')
<main class="page-content">
    <div class="container-fluid">
        
        {{-- Header & Tombol Tambah --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0 text-gray-800">Daftar Kandidat</h2>
                <p class="text-muted small mb-0">Kelola data pasangan calon ketua dan wakil.</p>
            </div>
            <a href="{{ route('admin.candidates.create') }}" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kandidat
            </a>
        </div>

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-uppercase text-secondary small font-weight-bold">
                            <tr>
                                <th class="px-4 py-3" width="5%">No</th>
                                <th class="px-4 py-3" width="20%">Agenda Pemilihan</th>
                                <th class="px-4 py-3 text-center" width="10%">No. Urut</th>
                                <th class="px-4 py-3" width="30%">Pasangan Kandidat</th>
                                <th class="px-4 py-3">Visi Singkat</th>
                                <th class="px-4 py-3 text-end" width="15%">Aksi</th> {{-- Lebar sedikit ditambah --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($candidates as $candidate)
                            <tr>
                                <td class="px-4">{{ $loop->iteration }}</td>
                                
                                {{-- Kolom Agenda Pemilihan --}}
                                <td class="px-4">
                                    <span class="badge bg-info text-dark bg-opacity-10 text-info border border-info rounded-pill px-3">
                                        {{ $candidate->election->title ?? 'Agenda Terhapus' }}
                                    </span>
                                </td>

                                {{-- Kolom Nomor Urut --}}
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm" 
                                         style="width: 35px; height: 35px; font-weight: bold;">
                                        {{ $candidate->nomor_urut }}
                                    </div>
                                </td>

                                {{-- Kolom Pasangan (Berdampingan) --}}
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        
                                        {{-- Area Foto Berdampingan --}}
                                        <div class="d-flex position-relative me-3" style="min-width: 90px;">
                                            {{-- Foto Ketua --}}
                                            <img src="{{ $candidate->photo_url ? asset('storage/' . $candidate->photo_url) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->name) }}" 
                                                 class="rounded-circle border border-2 border-white shadow-sm"
                                                 style="width: 50px; height: 50px; object-fit: cover; z-index: 2;"
                                                 alt="Ketua" data-bs-toggle="tooltip" title="Ketua">
                                            
                                            {{-- Foto Wakil (Jika Ada) --}}
                                            @if($candidate->vice_name)
                                                <img src="{{ $candidate->vice_photo ? asset('storage/' . $candidate->vice_photo) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->vice_name) }}" 
                                                     class="rounded-circle border border-2 border-white shadow-sm position-absolute start-50"
                                                     style="width: 50px; height: 50px; object-fit: cover; z-index: 1; left: 35px !important;"
                                                     alt="Wakil" data-bs-toggle="tooltip" title="Wakil">
                                            @endif
                                        </div>

                                        {{-- Area Nama --}}
                                        <div>
                                            <div class="fw-bold text-dark">{{ $candidate->name }}</div>
                                            @if($candidate->vice_name)
                                                <div class="small text-muted">
                                                    & {{ $candidate->vice_name }} <span class="badge bg-secondary ms-1" style="font-size: 0.6rem;">WAKIL</span>
                                                </div>
                                            @else
                                                <div class="small text-muted fst-italic">(Calon Tunggal)</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom Visi --}}
                                <td class="px-4 text-muted small">
                                    {{ Str::limit($candidate->description ?? 'Tidak ada visi & misi.', 60) }}
                                </td>

                                {{-- Kolom Aksi (Diedit menjadi Tombol) --}}
                                <td class="px-4 text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        {{-- Tombol detail --}}
                                        <a href="{{ route('admin.candidates.show', $candidate->id) }}" 
                                           class="btn btn-sm btn-primary text-white shadow-sm"
                                           data-bs-toggle="tooltip" 
                                           title="Show Data">
                                            <i data-feather="eye"></i>
                                        </a>
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.candidates.edit', $candidate->id) }}" 
                                           class="btn btn-sm btn-warning text-white shadow-sm"
                                           data-bs-toggle="tooltip" 
                                           title="Edit Data">
                                            <i data-feather="edit"></i>
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kandidat ini? Data tidak bisa dikembalikan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger shadow-sm" data-bs-toggle="tooltip" title="Hapus Data">
                                                <i data-feather="trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <img src="https://illustrations.popsy.co/gray/surr-waiting.svg" alt="Empty" style="height: 100px; opacity: 0.5" class="mb-3">
                                    <p class="mb-0">Belum ada kandidat yang terdaftar.</p>
                                    <small>Silakan klik tombol "Tambah Kandidat" di atas.</small>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection