@extends('admin.layouts.main')

@section('title', 'Detail Kandidat')

@section('content')
<main class="page-content">
    <div class="container-fluid">

        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Kandidat</h1>
            <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>

        <div class="row">
            
            {{-- KOLOM KIRI: Identitas Visual --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body text-center pt-5 pb-4">
                        
                        {{-- 1. Badge Nomor Urut Besar --}}
                        <div class="position-absolute top-0 end-0 mt-3 me-3">
                            <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow" 
                                 style="width: 60px; height: 60px; font-size: 1.5rem; font-weight: bold;">
                                {{ $candidate->nomor_urut }}
                            </div>
                        </div>

                        {{-- 2. Foto Pasangan (Logic Besar) --}}
                        <div class="d-flex justify-content-center align-items-center mb-4 position-relative" style="height: 160px;">
                            
                            {{-- Foto Ketua --}}
                            <img src="{{ $candidate->photo_url ? asset('storage/' . $candidate->photo_url) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->name) }}" 
                                 class="rounded-circle border border-4 border-white shadow"
                                 style="width: 140px; height: 140px; object-fit: cover; z-index: 2; position: relative; {{ $candidate->vice_name ? 'right: -20px;' : '' }}"
                                 alt="Ketua">
                            
                            {{-- Foto Wakil (Jika Ada) --}}
                            @if($candidate->vice_name)
                                <img src="{{ $candidate->vice_photo ? asset('storage/' . $candidate->vice_photo) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->vice_name) }}" 
                                     class="rounded-circle border border-4 border-white shadow"
                                     style="width: 130px; height: 130px; object-fit: cover; z-index: 1; position: relative; left: -20px; filter: brightness(95%);"
                                     alt="Wakil">
                            @endif
                        </div>

                        {{-- 3. Nama Pasangan --}}
                        <h4 class="fw-bold text-dark mb-1">{{ $candidate->name }}</h4>
                        <div class="text-primary small fw-bold text-uppercase mb-3">Calon Ketua</div>

                        @if($candidate->vice_name)
                            <div class="border-top w-50 mx-auto my-3"></div>
                            <h5 class="fw-bold text-secondary mb-1">{{ $candidate->vice_name }}</h5>
                            <div class="text-info small fw-bold text-uppercase">Calon Wakil</div>
                        @endif

                        <hr class="my-4">

                        {{-- 4. Info Election --}}
                        <div class="text-start bg-light p-3 rounded">
                            <small class="text-muted text-uppercase fw-bold d-block mb-2">Terdaftar Pada Pemilihan:</small>
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-primary text-white me-3" style="width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-vote-yea"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-dark">{{ $candidate->election->title ?? 'Data Terhapus' }}</h6>
                                    <span class="badge bg-secondary rounded-pill" style="font-size: 0.7em;">
                                        {{ ucfirst($candidate->election->status ?? '-') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    {{-- Footer: Tombol Aksi --}}
                    <div class="card-footer bg-white p-3">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i> Edit Data Kandidat
                            </a>
                            <form action="{{ route('admin.candidates.destroy', $candidate->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger w-100">
                                    <i class="fas fa-trash me-2"></i> Hapus Kandidat
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: Visi & Misi --}}
            <div class="col-lg-8">
                
                {{-- Card Visi --}}
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white py-3 border-left-primary">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-bullseye me-2"></i> Visi & misi
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($candidate->description)
                            <p class="lead text-dark fst-italic mb-0">"{{ $candidate->description }}"</p>
                        @else
                            <p class="text-muted fst-italic mb-0">Belum ada visi & misi yang diinputkan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection