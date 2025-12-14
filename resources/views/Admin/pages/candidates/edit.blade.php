@extends('admin.layouts.main')

@section('title', 'Edit Data Kandidat')

@section('content')
<main class="page-content">
    <div class="container-fluid">
        <div class="card shadow-sm" style="max-width: 900px; margin: 0 auto;">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 font-weight-bold text-primary">Edit Data Kandidat</h5>
            </div>
            <div class="card-body">
                
                <form action="{{ route('admin.candidates.update', $candidate->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Wajib ada untuk update data --}}
                    
                    {{-- 1. Election & Nomor Urut --}}
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label font-weight-bold">Periode Pemilihan (Election)</label>
                            <select name="election_id" class="form-select @error('election_id') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                @foreach($elections as $election)
                                    <option value="{{ $election->id }}" 
                                        {{ old('election_id', $candidate->election_id) == $election->id ? 'selected' : '' }}>
                                        {{ $election->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('election_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label font-weight-bold">Nomor Urut</label>
                            <input type="number" name="nomor_urut" class="form-control @error('nomor_urut') is-invalid @enderror" 
                                   value="{{ old('nomor_urut', $candidate->nomor_urut) }}" required>
                            @error('nomor_urut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <hr>

                    {{-- 2. Data Calon (Split Ketua & Wakil) --}}
                    <div class="row">
                        {{-- KIRI: DATA KETUA --}}
                        <div class="col-md-6">
                            <div class="card bg-light border-0 mb-3 h-100">
                                <div class="card-body">
                                    <h6 class="font-weight-bold text-primary mb-3">Data Ketua</h6>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Nama Ketua <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                               value="{{ old('name', $candidate->name) }}" required>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Foto Ketua</label>
                                        
                                        {{-- Preview Foto Lama --}}
                                        @if($candidate->photo_url)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $candidate->photo_url) }}" alt="Foto Ketua" class="img-thumbnail" style="height: 100px;">
                                            </div>
                                        @endif

                                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah foto.</small>
                                        @error('photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- KANAN: DATA WAKIL --}}
                        <div class="col-md-6">
                            <div class="card bg-light border-0 mb-3 h-100">
                                <div class="card-body">
                                    <h6 class="font-weight-bold text-info mb-3">Data Wakil (Opsional)</h6>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Nama Wakil</label>
                                        <input type="text" name="vice_name" class="form-control @error('vice_name') is-invalid @enderror" 
                                               value="{{ old('vice_name', $candidate->vice_name) }}" placeholder="Kosongkan jika tunggal">
                                        @error('vice_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Foto Wakil</label>

                                        {{-- Preview Foto Lama --}}
                                        @if($candidate->vice_photo)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $candidate->vice_photo) }}" alt="Foto Wakil" class="img-thumbnail" style="height: 100px;">
                                            </div>
                                        @endif

                                        <input type="file" name="vice_photo" class="form-control @error('vice_photo') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted d-block mt-1">Biarkan kosong jika tidak ingin mengubah foto.</small>
                                        @error('vice_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- 3. Visi & Misi --}}
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
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
@endsection