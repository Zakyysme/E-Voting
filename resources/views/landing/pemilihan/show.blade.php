@extends('landing.layout.app')

@section('content')
@php
$hasVoted = false;
if(Auth::check()){
$hasVoted = \App\Models\Vote::where('user_id', Auth::id())
->where('election_id', $election->id)
->exists();
}
@endphp

<section class="pt-120 pb-90">
    <div class="container">
        <div class="section-title text-center mb-50">
            <h2>Kandidat: {{ $election->title }}</h2>
            <p>{{ $election->description }}</p>

            @if($hasVoted)
            <div class="alert alert-success d-inline-block mt-2">
                <i class="bi bi-check-circle-fill"></i> Anda telah memberikan suara pada pemilihan ini.
            </div>
            @endif
        </div>

        <div class="row">
            @foreach($election->candidates as $candidate)
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="row">
                        <div class="col">
                            <img src="{{ asset('storage/' . $candidate->photo_url) }}" class="card-img-top" alt="...">
                        </div>
                        <div class="col">
                            <img src="{{ asset('storage/' . $candidate->vice_photo) }}" class="card-img-top" alt="...">
                        </div>
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">{{ $candidate->name }} & {{ $candidate->vice_name }}</h5>

                        @auth
                        @if($hasVoted)
                        <button type="button" class="btn btn-secondary w-100" disabled>
                            <i class="bi bi-check-circle"></i> Sudah Memilih
                        </button>
                        @else
                        <form action="{{ route('vote.store', $election->id) }}" method="POST">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="submit" class="btn btn-primary w-100">Pilih Kandidat Ini</button>
                        </form>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="btn btn-secondary mt-3">Login untuk Memilih</a>
                        @endauth
                    </div>
                    <div class="w-100">
                            <a href="{{ route('election.result', $election->id) }}" class="btn btn-primary w-100">
                                <i class="bi bi-graph-up"></i> Lihat Hasil
                            </a>
                        </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<div class="modal fade" id="receiptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Berhasil Memilih!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
                <h4 class="mt-3">Terima Kasih!</h4>
                <p>Suara Anda telah dienkripsi dan disimpan secara aman dalam sistem.</p>
                <hr>
                <p class="small text-muted mb-1">ID Bukti Pemilihan (Receipt Hash):</p>
                <div class="p-3 bg-light border rounded text-break" style="font-family: monospace;">
                    <strong>{{ session('receipt') }}</strong>
                </div>
                <p class="mt-3 small text-danger">*Harap simpan kode ini sebagai bukti sah pilihan Anda.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection
@if(session('receipt'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengambil elemen modal berdasarkan ID 'receiptModal'
        var receiptModal = new bootstrap.Modal(document.getElementById('receiptModal'));
        receiptModal.show();
    });
</script>
@endif