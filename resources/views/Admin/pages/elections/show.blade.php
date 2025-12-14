@extends('admin.layouts.main')

@section('title', 'Detail Pemilihan')

@section('content')
<main class="page-content">
    <div class="container-fluid">

        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Pemilihan</h1>
            <a href="{{ route('admin.elections.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>

        <div class="row">
            {{-- Kolom Kiri: Detail Informasi Pemilihan --}}
            <div class="col-lg-4 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Informasi Utama</h6>

                        {{-- Badge Status --}}
                        @if($election->status == 'draft')
                            <span class="badge bg-secondary">Draft</span>
                        @elseif($election->status == 'running')
                            <span class="badge bg-success">Sedang Berjalan</span>
                        @elseif($election->status == 'finished')
                            <span class="badge bg-danger">Selesai</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <h4 class="font-weight-bold mb-3">{{ $election->title }}</h4>

                        <p class="text-muted">
                            {{ $election->description ?? 'Tidak ada deskripsi.' }}
                        </p>

                        <hr>

                        <div class="mb-3">
                            <small class="text-uppercase text-secondary font-weight-bold">Waktu Mulai</small>
                            <div class="h6">
                                <i class="fas fa-calendar-alt text-primary"></i>
                                {{ \Carbon\Carbon::parse($election->start_at)->format('d M Y, H:i') }} WIB
                            </div>
                        </div>

                        <div class="mb-4">
                            <small class="text-uppercase text-secondary font-weight-bold">Waktu Selesai</small>
                            <div class="h6">
                                <i class="fas fa-flag-checkered text-danger"></i>
                                {{ \Carbon\Carbon::parse($election->end_at)->format('d M Y, H:i') }} WIB
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.elections.edit', $election->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>

                            <form action="{{ route('admin.elections.destroy', $election->id) }}" method="POST" class="d-grid" onsubmit="return confirm('Yakin ingin menghapus pemilihan ini? Data kandidat dan suara juga akan terhapus.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fas fa-trash"></i> Hapus Pemilihan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Daftar Kandidat --}}
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Daftar Kandidat ({{ $election->candidates->count() }})</h6>
                    </div>
                    <div class="card-body">

                        @if($election->candidates->count() > 0)
                            <div class="row">
                                @foreach($election->candidates as $candidate)
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-left-primary shadow-sm">
                                        <div class="card-body">
                                            
                                            {{-- Header Card: Nomor Urut --}}
                                            <div class="d-flex justify-content-between mb-3">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase">
                                                    Kandidat
                                                </div>
                                                <span class="badge bg-primary rounded-circle" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">
                                                    {{ $candidate->nomor_urut }}
                                                </span>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                {{-- Area Foto (Logic Tumpuk/Overlapping) --}}
                                                <div class="position-relative me-3 flex-shrink-0" style="width: 80px; height: 60px;">
                                                    {{-- Foto Ketua --}}
                                                    <img src="{{ $candidate->photo_url ? asset('storage/' . $candidate->photo_url) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->name) }}" 
                                                         class="rounded-circle border border-2 border-white shadow-sm position-absolute"
                                                         style="width: 50px; height: 50px; object-fit: cover; z-index: 2; top: 0; left: 0;"
                                                         alt="Ketua" title="Ketua: {{ $candidate->name }}">
                                                    
                                                    {{-- Foto Wakil (Jika Ada) --}}
                                                    @if($candidate->vice_name)
                                                        <img src="{{ $candidate->vice_photo ? asset('storage/' . $candidate->vice_photo) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->vice_name) }}" 
                                                             class="rounded-circle border border-2 border-white shadow-sm position-absolute"
                                                             style="width: 50px; height: 50px; object-fit: cover; z-index: 1; top: 0; left: 30px;"
                                                             alt="Wakil" title="Wakil: {{ $candidate->vice_name }}">
                                                    @endif
                                                </div>

                                                {{-- Area Nama --}}
                                                <div class="flex-grow-1">
                                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                                        {{ $candidate->name }}
                                                    </div>
                                                    @if($candidate->vice_name)
                                                        <div class="small text-muted">
                                                            & {{ $candidate->vice_name }} <span class="badge bg-light text-dark border ms-1" style="font-size: 0.6em">WAKIL</span>
                                                        </div>
                                                    @else
                                                        <div class="small text-muted fst-italic">Calon Tunggal</div>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- Visi Singkat --}}
                                            <hr class="my-3">
                                            <div class="text-sm text-muted">
                                                <strong>Visi & misi:</strong><br>
                                                {{ Str::limit($candidate->description ?? 'Belum mengisi visi.', 80) }}
                                            </div>

                                        </div>
                                        
                                        {{-- Footer Actions --}}
                                        <div class="card-footer bg-white text-center">
                                            <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-sm btn-light text-primary w-100">
                                                Detail & Edit <i class="fas fa-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            {{-- State Kosong --}}
                            <div class="text-center py-5">
                                <img src="https://illustrations.popsy.co/gray/surr-waiting.svg" alt="Empty" style="height: 150px; opacity: 0.5">
                                <p class="text-muted mt-3">Belum ada kandidat yang terdaftar untuk pemilihan ini.</p>
                                <a href="{{ route('admin.candidates.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Tambah Kandidat Sekarang
                                </a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection