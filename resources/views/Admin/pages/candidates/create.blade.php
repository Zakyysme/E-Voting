@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
<main class="page-content">
<div class="container-fluid">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h4 class="mb-0">Tambah Kandidat Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Pilih Periode Pemilihan (Election)</label>
                    <select name="election_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach($elections as $election)
                        <option value="{{ $election->id }}">{{ $election->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Kandidat</label>
                    <input type="text" name="name" class="form-control" required placeholder="Contoh: Ketua OSIS 1">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Kandidat</label>
                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG. Maks 2MB.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Visi, Misi / Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Tuliskan visi misi disini..."></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Kandidat</button>
                </div>
            </form>
        </div>
    </div>
</div></main>
@endsection