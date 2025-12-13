@extends('admin.layouts.main')

@section('title', 'Ecommerce Dashboard')

@section('content')
<main class="page-content">
<div class="container-fluid">
    <h2>Rekapitulasi Suara</h2>
    <p class="text-muted">Pilih periode pemilihan untuk melihat hasil Real Count.</p>

    <div class="row mt-4">
        @foreach($elections as $election)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-bold">{{ $election->title }}</h5>
                    <p class="card-text text-muted small">
                        Status: <span class="badge bg-{{ $election->status == 'running' ? 'success' : 'secondary' }}">{{ strtoupper($election->status) }}</span>
                    </p>
                    <a href="{{ route('admin.votes.show', $election->id) }}" class="btn btn-outline-primary w-100 stretched-link">
                        Lihat Hasil <i class="bi bi-bar-chart-fill"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</main>
@endsection