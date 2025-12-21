@extends('landing.layout.app')

@section('content')
<section class="pt-120 pb-90">
    <div class="container">
        <div class="section-title text-center mb-50">
            <h2 class="mb-2">Hasil Quick Count</h2>
            <p class="text-muted">{{ $election->title }}</p>
            <span class="badge bg-primary fs-6">Total Suara Masuk: {{ $totalVotes }}</span>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <canvas id="voteChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            @foreach($candidates as $candidate)
            @php
                // Menghindari error division by zero jika belum ada yang vote
                $percentage = $totalVotes > 0 ? ($candidate->votes_count / $totalVotes) * 100 : 0;
            @endphp
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body text-center p-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%; border: 3px solid #eee;" class="me-2">
                                <img src="{{ asset('storage/' . $candidate->photo_url) }}" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                            <div style="width: 80px; height: 80px; overflow: hidden; border-radius: 50%; border: 3px solid #eee;">
                                <img src="{{ asset('storage/' . $candidate->vice_photo) }}" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                        </div>

                        <h5 class="card-title fw-bold">{{ $candidate->name }}</h5>
                        <p class="text-muted small">& {{ $candidate->vice_name }}</p>
                        
                        <div class="progress mb-3" style="height: 25px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: {{ number_format($percentage, 1) }}%;" 
                                 aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                {{ number_format($percentage, 1) }}%
                            </div>
                        </div>

                        <h2 class="text-primary fw-bold">{{ $candidate->votes_count }}</h2>
                        <span class="text-muted">Suara</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-4">
            <a href="{{ url()->current() }}" class="btn btn-outline-primary">
                <i class="bi bi-arrow-clockwise"></i> Refresh Data
            </a>
            <a href="{{ url('/') }}" class="btn btn-secondary ms-2">Kembali ke Home</a>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Persiapan Data dari PHP ke JS
        const labels = @json($candidates->pluck('name'));
        const dataVotes = @json($candidates->pluck('votes_count'));
        
        // Warna background (bisa disesuaikan atau dibuat dinamis)
        const backgroundColors = [
            'rgba(54, 162, 235, 0.6)', // Biru
            'rgba(255, 99, 132, 0.6)', // Merah
            'rgba(255, 206, 86, 0.6)', // Kuning
            'rgba(75, 192, 192, 0.6)', // Hijau
            'rgba(153, 102, 255, 0.6)' // Ungu
        ];

        const ctx = document.getElementById('voteChart').getContext('2d');
        const voteChart = new Chart(ctx, {
            type: 'bar', // Bisa diganti 'pie' atau 'doughnut'
            data: {
                labels: labels,
                datasets: [{
                    label: 'Perolehan Suara',
                    data: dataVotes,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(c => c.replace('0.6', '1')), // Border lebih tebal
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Agar angka di sumbu Y tidak desimal (1.5 orang)
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false // Sembunyikan legenda jika chart bar sederhana
                    }
                }
            }
        });
    });
</script>
@endsection