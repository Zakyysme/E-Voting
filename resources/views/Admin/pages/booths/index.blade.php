@extends('admin.layouts.main')

@section('title', 'Pengaturan Bilik Suara')

@section('content')
<main class="page-content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0 text-gray-800 fw-bold">Manajemen Bilik Suara</h2>
                <p class="text-muted small mb-0">Kelola perangkat/lokasi pemungutan suara.</p>
            </div>
            {{-- Tombol Trigger Modal --}}
            <button type="button" class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addBoothModal">
                <i class="fas fa-plus me-1"></i> Tambah Bilik Baru
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            {{-- Info Card --}}
            <div class="col-12 mb-4">
                <div class="card bg-primary text-white shadow-sm border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="fw-bold"><i class="fas fa-info-circle me-2"></i>Cara Kerja Bilik</h5>
                            <p class="mb-0 small opacity-75">
                                Kode akses digunakan untuk login pada perangkat pemilih. 
                                Pastikan kode ini hanya diketahui oleh panitia penjaga bilik.
                            </p>
                        </div>
                        <i class="fas fa-laptop-house fa-4x opacity-25"></i>
                    </div>
                </div>
            </div>

            {{-- Tabel Daftar Bilik --}}
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-uppercase small fw-bold text-secondary">
                                    <tr>
                                        <th class="px-4 py-3">Nama Bilik & Lokasi</th>
                                        <th class="px-4 py-3 text-center">Status</th>
                                        <th class="px-4 py-3 text-center">Kode Akses</th>
                                        <th class="px-4 py-3 text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($booths as $booth)
                                    <tr>
                                        <td class="px-4">
                                            <div class="fw-bold text-dark">{{ $booth->name }}</div>
                                            <div class="small text-muted">
                                                <i class="fas fa-map-marker-alt me-1 text-danger"></i> 
                                                {{ $booth->location ?? 'Lokasi tidak diset' }}
                                            </div>
                                        </td>
                                        
                                        {{-- Status Toggle --}}
                                        <td class="text-center">
                                            <form action="{{ route('admin.booths.toggle', $booth->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="btn btn-sm rounded-pill {{ $booth->is_active ? 'btn-success bg-opacity-25 text-success border-0 fw-bold' : 'btn-secondary bg-opacity-25 text-secondary border-0' }}">
                                                    {{ $booth->is_active ? '● AKTIF' : '○ NON-AKTIF' }}
                                                </button>
                                            </form>
                                        </td>

                                        {{-- Kode Akses --}}
                                        <td class="text-center">
                                            <div class="input-group input-group-sm justify-content-center" style="width: 200px; margin: 0 auto;">
                                                <span class="input-group-text bg-light fw-bold font-monospace text-primary border-primary">
                                                    {{ $booth->access_code }}
                                                </span>
                                                <button class="btn btn-outline-primary" type="button" onclick="copyToClipboard('{{ $booth->access_code }}')" title="Salin Kode">
                                                    <i class="fas fa-copy"></i>
                                                </button>
                                                <form action="{{ route('admin.booths.reset', $booth->id) }}" method="POST" onsubmit="return confirm('Reset kode akses bilik ini? Petugas bilik harus login ulang.');">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="btn btn-outline-danger" title="Acak Ulang Kode">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                        {{-- Aksi --}}
                                        <td class="px-4 text-end">
                                            <form action="{{ route('admin.booths.destroy', $booth->id) }}" method="POST" onsubmit="return confirm('Hapus bilik ini?');">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-light text-danger border shadow-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <img src="https://illustrations.popsy.co/gray/surr-waiting.svg" height="100" class="opacity-50 mb-3">
                                            <p>Belum ada bilik suara yang dibuat.</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH BILIK --}}
    <div class="modal fade" id="addBoothModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Bilik Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.booths.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Bilik <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Bilik 01, Lab Komputer 1" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Lokasi (Opsional)</label>
                            <input type="text" name="location" class="form-control" placeholder="Contoh: Gedung A, Lantai 2">
                        </div>
                        <div class="alert alert-warning small mb-0">
                            <i class="fas fa-exclamation-triangle me-1"></i>
                            Kode akses akan digenerate otomatis oleh sistem setelah disimpan.
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Bilik</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>

{{-- Script Copy to Clipboard --}}
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Opsional: Ganti icon sementara atau tampilkan toast
            alert('Kode akses berhasil disalin: ' + text);
        }, function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }
</script>
@endsection