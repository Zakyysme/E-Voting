@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
<main class="page-content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Manajemen Periode Pemilihan</h2>
            <a href="{{ route('admin.elections.create') }}" class="btn btn-primary">
                + Buat Pemilihan Baru
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
                                <th>No</th>
                                <th>Judul Pemilihan</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Status</th>
                                <th>Jml Kandidat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($elections as $election)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="fw-bold">{{ $election->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($election->start_at)->format('d M Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($election->end_at)->format('d M Y H:i') }}</td>
                                <td>
                                    @if($election->status == 'running')
                                    <span class="badge bg-success">Berjalan</span>
                                    @elseif($election->status == 'finished')
                                    <span class="badge bg-secondary">Selesai</span>
                                    @else
                                    <span class="badge bg-warning text-dark">Draft</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $election->candidates_count }}</td>
                                <td>
                                    <a href="{{ route('admin.elections.show', $election->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="{{ route('admin.elections.edit', $election->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.elections.destroy', $election->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus agenda ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada agenda pemilihan.</td>
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