@extends('admin.layouts.main')

@section('title', 'Hasil Perhitungan Suara')

@section('content')
<main class="page-content">
    <div class="container-fluid">
        
        {{-- Header Page --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h3 mb-0 text-gray-800 fw-bold">Hasil Perhitungan Suara</h2>
                <h5 class="text-muted mb-0">Agenda: {{ $election->title }}</h5>
            </div>
            <a href="{{ route('admin.votes.index') }}" class="btn btn-secondary shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="row">
            {{-- KOLOM KIRI: GRAFIK DONUT --}}
            <div class="col-lg-5 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Grafik Statistik</h6>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <div style="width: 100%; max-width: 350px;">
                            <canvas id="voteChart"></canvas>
                        </div>
                        <div class="mt-4 text-center">
                            <span class="h2 font-weight-bold text-dark">{{ $totalVotes }}</span>
                            <div class="text-muted small text-uppercase ls-1">Total Suara Masuk</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: TABEL RINCIAN --}}
            <div class="col-lg-7 mb-4">
                <div class="card shadow-sm h-100 border-0">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Rincian Perolehan</h6>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success px-3">
                            Status: {{ ucfirst($election->status) }}
                        </span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-secondary small text-uppercase">
                                    <tr>
                                        <th class="px-4 py-3">Kandidat</th>
                                        <th class="px-4 py-3 text-center">Perolehan</th>
                                        <th class="px-4 py-3" style="width: 30%;">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($election->candidates as $candidate)
                                    @php
                                        $percentage = $totalVotes > 0 ? ($candidate->votes_count / $totalVotes) * 100 : 0;
                                        // Cek apakah ini suara terbanyak sementara
                                        $isLeading = $loop->first && $candidate->votes_count > 0; 
                                    @endphp
                                    <tr class="{{ $isLeading ? 'bg-warning bg-opacity-10' : '' }}">
                                        {{-- 1. Info Kandidat (Foto & Nama) --}}
                                        <td class="px-4 py-3">
                                            <div class="d-flex align-items-center">
                                                {{-- Badge Nomor Urut --}}
                                                <div class="me-3 text-center">
                                                    <div class="small text-muted fw-bold">No.</div>
                                                    <div class="h5 mb-0 fw-bold text-primary">{{ $candidate->nomor_urut }}</div>
                                                </div>

                                                {{-- Foto Overlapping (Ketua & Wakil) --}}
                                                <div class="d-flex position-relative me-3" style="min-width: 80px;">
                                                    <img src="{{ $candidate->photo_url ? asset('storage/' . $candidate->photo_url) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->name) }}" 
                                                         class="rounded-circle border border-2 border-white shadow-sm"
                                                         style="width: 45px; height: 45px; object-fit: cover; z-index: 2;"
                                                         alt="Ketua">
                                                    
                                                    @if($candidate->vice_name)
                                                        <img src="{{ $candidate->vice_photo ? asset('storage/' . $candidate->vice_photo) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->vice_name) }}" 
                                                             class="rounded-circle border border-2 border-white shadow-sm position-absolute start-50"
                                                             style="width: 45px; height: 45px; object-fit: cover; z-index: 1; left: 30px !important;"
                                                             alt="Wakil">
                                                    @endif
                                                </div>

                                                {{-- Nama --}}
                                                <div>
                                                    <div class="fw-bold text-dark">{{ $candidate->name }}</div>
                                                    @if($candidate->vice_name)
                                                        <div class="small text-muted">& {{ $candidate->vice_name }}</div>
                                                    @else
                                                        <div class="small text-muted fst-italic">(Tunggal)</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>

                                        {{-- 2. Jumlah Suara --}}
                                        <td class="text-center">
                                            <div class="h5 mb-0 fw-bold">{{ $candidate->votes_count }}</div>
                                            <small class="text-muted">Suara</small>
                                        </td>

                                        {{-- 3. Persentase & Progress Bar --}}
                                        <td class="px-4">
                                            <div class="d-flex align-items-center mb-1">
                                                <span class="fw-bold me-2">{{ number_format($percentage, 1) }}%</span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar {{ $isLeading ? 'bg-success' : 'bg-primary' }}" 
                                                     role="progressbar" 
                                                     style="width: {{ $percentage }}%" 
                                                     aria-valuenow="{{ $percentage }}" 
                                                     aria-valuemin="0" 
                                                     aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Script Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ambil data dari Controller
    const myLabels = <?php echo json_encode($chartLabels); ?>;
    const myData = <?php echo json_encode($chartData); ?>;

    const ctx = document.getElementById('voteChart').getContext('2d');
    const voteChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: myLabels,
            datasets: [{
                data: myData,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'
                ],
                hoverBackgroundColor: [
                    '#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#be2617', '#60616f', '#373840'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
                borderWidth: 2
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            layout: {
                padding: 10
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        boxWidth: 15,
                        padding: 15
                    }
                },
                tooltip: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    titleColor: '#6e707e',
                    displayColors: true,
                    caretPadding: 10,
                }
            },
            cutout: '70%', // Membuat lubang donut lebih besar agar modern
        }
    });
</script>
@endsection