@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
<main class="page-content">
<div class="container-fluid">
    <div class="card shadow-sm" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h4 class="mb-0">Buat Agenda Pemilihan Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.elections.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Judul Pemilihan</label>
                    <input type="text" name="title" class="form-control" placeholder="Contoh: Pemilihan Ketua OSIS 2025" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Mulai</label>
                        <input type="datetime-local" name="start_at" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Waktu Selesai</label>
                        <input type="datetime-local" name="end_at" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi / Keterangan</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="alert alert-info small">
                    <i class="bi bi-info-circle"></i> Status awal akan diset sebagai <b>Draft</b>. Anda bisa mengubahnya menjadi <b>Running</b> (Berjalan) nanti.
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.elections.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Agenda</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@endsection