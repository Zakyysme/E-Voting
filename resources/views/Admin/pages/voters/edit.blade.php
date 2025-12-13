@extends('admin.layouts.main')

@section('title', 'Ecommerce Dashboard')

@section('content')
<main class="page-content">
<div class="container-fluid">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h4 class="mb-0">Edit Data Pemilih</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.voters.update', $voter->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ $voter->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $voter->email }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="text" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti password">
                    <div class="form-text text-danger">Hanya isi jika Anda ingin mereset password user ini.</div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.voters.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div></main>
@endsection