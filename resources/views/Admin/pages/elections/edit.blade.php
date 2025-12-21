@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
<main class="page-content">
<div class="container-fluid>
    <div class="card shadow-sm" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h4 class="mb-0">Edit Agenda Pemilihan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.elections.update', $election->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control" accept="image/*">
                </div>
                <div class="mb-3">
                    <label class="form-label">Judul Pemilihan</label>
                    <input type="text" name="title" class="form-control" value="{{ $election->title }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" {{ $election->status == 'draft' ? 'selected' : '' }}>Draft (Persiapan)</option>
                        <option value="running" {{ $election->status == 'running' ? 'selected' : '' }}>Running (Sedang Berjalan)</option>
                        <option value="finished" {{ $election->status == 'finished' ? 'selected' : '' }}>Finished (Selesai)</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Mulai</label>
                        {{-- Format datetime-local butuh Y-m-d\TH:i --}}
                        <input type="datetime-local" name="start_at" class="form-control" 
                               value="{{ \Carbon\Carbon::parse($election->start_at)->format('Y-m-d\TH:i') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="datetime-local" name="end_at" class="form-control" 
                               value="{{ \Carbon\Carbon::parse($election->end_at)->format('Y-m-d\TH:i') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ $election->description }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.elections.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@endsection