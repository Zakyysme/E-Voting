@extends('admin.layouts.main')

@section('title', 'Ecommerce Dashboard')

@section('content')
<main class="page-content">
<div class="container-fluid>
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h4 class="mb-0">Registrasi Pemilih Baru</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.voters.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" placeholder="Nama Pemilih" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email (Username Login)</label>
                    <input type="email" name="email" class="form-control" placeholder="user@example.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Awal</label>
                    <input type="text" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                    <div class="form-text">Password ini digunakan pemilih untuk login.</div>
                </div>

                <div class="alert alert-warning small">
                    <i class="bi bi-exclamation-circle"></i> Role user ini akan otomatis diset sebagai <b>Voter</b>.
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.voters.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@endsection