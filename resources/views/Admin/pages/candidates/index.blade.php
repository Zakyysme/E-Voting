@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
<main class="page-content">
<div class="container-fluid>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Daftar Kandidat</h2>
        <a href="{{ route('admin.candidates.create') }}" class="btn btn-primary">
            + Tambah Kandidat
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
                            <th width="15%">Foto</th>
                            <th width="20%">Nama Kandidat</th>
                            <th>Visi & Misi / Deskripsi</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($candidates as $key => $candidate)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($candidate->photo_url)
                                    <img src="{{ asset('storage/' . $candidate->photo_url) }}" 
                                         alt="Foto {{ $candidate->name }}" 
                                         class="img-thumbnail" 
                                         style="height: 80px; width: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $candidate->name }}</td>
                            <td>{{ Str::limit($candidate->description, 100) }}</td>
                            <td>
                                <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                
                                <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kandidat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <p class="text-muted mb-0">Belum ada data kandidat.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div></main>
@endsection