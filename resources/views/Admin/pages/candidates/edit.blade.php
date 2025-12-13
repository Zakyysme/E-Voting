@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
<main class="page-content">
<div class="container-fluid">
    <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
        <div class="card-header bg-white">
            <h4 class="mb-0">Edit Data Kandidat</h4>
        </div>
        <div class="card-body">
            {{-- Perhatikan route update membutuhkan ID kandidat --}}
            <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Penting: Ubah method POST menjadi PUT untuk update --}}
                
                <div class="mb-3">
                    <label class="form-label">Nama Kandidat</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $candidate->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Kandidat</label>
                    
                    {{-- Menampilkan foto saat ini jika ada --}}
                    @if($candidate->photo_url)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $candidate->photo_url) }}" alt="Foto Saat Ini" class="img-thumbnail" style="max-height: 150px;">
                            <div class="form-text text-muted">Foto saat ini.</div>
                        </div>
                    @endif

                    <input type="file" name="photo" class="form-control" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. (Maks 2MB)</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Visi, Misi / Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $candidate->description) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div></main>
@endsection