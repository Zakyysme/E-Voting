@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
<main class="page-content">
<div class="container-fluid>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Detail Kandidat</h4>
                    <a href="{{ route('admin.candidates.index') }}" class="btn btn-sm btn-secondary">
                        &larr; Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        {{-- Kolom Kiri: Foto --}}
                        <div class="col-md-4 text-center">
                            @if($candidate->photo_url)
                                <img src="{{ asset('storage/' . $candidate->photo_url) }}" 
                                     alt="{{ $candidate->name }}" 
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 300px; width: 100%; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px; border: 2px dashed #ccc;">
                                    <span class="text-muted">Tidak ada foto</span>
                                </div>
                            @endif
                        </div>

                        {{-- Kolom Kanan: Informasi --}}
                        <div class="col-md-8">
                            <h2 class="fw-bold text-primary mb-3">{{ $candidate->name }}</h2>
                            
                            <h5 class="text-muted border-bottom pb-2">Visi & Misi / Deskripsi</h5>
                            
                            <div class="description-content mt-3">
                                @if($candidate->description)
                                    {{-- nl2br e() berfungsi agar enter/baris baru di textarea terbaca --}}
                                    <p style="white-space: pre-line;">{!! nl2br(e($candidate->description)) !!}</p>
                                @else
                                    <p class="text-muted fst-italic">Belum ada deskripsi untuk kandidat ini.</p>
                                @endif
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil"></i> Edit Data
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></main>
@endsection