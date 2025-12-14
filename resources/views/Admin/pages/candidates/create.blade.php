@extends('admin.layouts.main')

@section('title', 'Tambah Kandidat Baru')

@section('content')
<main class="page-content">
    <div class="container-fluid">
        <div class="card shadow-sm" style="max-width: 800px; margin: 0 auto;">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 font-weight-bold text-primary">Tambah Kandidat Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.candidates.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- 1. Pilih Election --}}
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Pilih Periode Pemilihan (Election) <span class="text-danger">*</span></label>
                        <select name="election_id" class="form-select @error('election_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Agenda Pemilihan --</option>
                            @foreach($elections as $election)
                                <option value="{{ $election->id }}" {{ old('election_id') == $election->id ? 'selected' : '' }}>
                                    {{ $election->title }} (Status: {{ ucfirst($election->status) }})
                                </option>
                            @endforeach
                        </select>
                        @error('election_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                            <label class="form-label font-weight-bold">Nomor Urut <span class="text-danger">*</span></label>
                            <input type="number" name="nomor_urut" class="form-control @error('nomor_urut') is-invalid @enderror" value="{{ old('nomor_urut') }}" placeholder="1, 2, 3..." required>
                            <small class="text-muted">Harus unik dalam satu pemilihan.</small>
                            @error('nomor_urut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    {{-- ... kode sebelumnya (Election & Nomor Urut) ... --}}

<div class="row">
    {{-- KOLOM KIRI: KETUA --}}
    <div class="col-md-6">
        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                <h6 class="font-weight-bold text-primary mb-3">Data Calon Ketua</h6>
                
                <div class="mb-3">
                    <label class="form-label">Nama Ketua <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Ketua</label>
                    <input type="file" name="photo_url" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    </div>

    {{-- KOLOM KANAN: WAKIL --}}
    <div class="col-md-6">
        <div class="card bg-light border-0 mb-3">
            <div class="card-body">
                <h6 class="font-weight-bold text-info mb-3">Data Calon Wakil (Opsional)</h6>
                
                <div class="mb-3">
                    <label class="form-label">Nama Wakil</label>
                    <input type="text" name="vice_name" class="form-control" value="{{ old('vice_name') }}" placeholder="Kosongkan jika tunggal">
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Wakil</label>
                    <input type="file" name="vice_photo" class="form-control" accept="image/*">
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ... kode selanjutnya (Visi & Misi) ... --}}

                    <hr>

                    {{-- 5. Visi --}}
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Visi misi</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4" placeholder="Tuliskan visi dan misi...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Kandidat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection