@extends('admin.layouts.main')

@section('title', 'Ecommerce Dashboard')

@section('content')
<main class="page-content">
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Pemilih Tetap (DPT)</h2>
        <a href="{{ route('admin.voters.create') }}" class="btn btn-primary">
            + Tambah Pemilih Manual
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Lengkap</th>
                            <th>Email / Username</th>
                            <th>Status Akun</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($voters as $index => $voter)
                        <tr>
                            {{-- Logic penomoran agar sesuai halaman pagination --}}
                            <td>{{ $voters->firstItem() + $index }}</td>
                            <td class="fw-bold">{{ $voter->name }}</td>
                            <td>{{ $voter->email }}</td>
                            <td>
                                <span class="badge bg-success">Aktif</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.voters.edit', $voter->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.voters.destroy', $voter->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pemilih ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada data pemilih.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="mt-3">
                {{ $voters->links() }}
            </div>
        </div>
    </div>
</div></main>
@endsection