@extends('admin.layouts.main')

@section('title', 'Ecommerce Dashboard')

@section('content')
<main class="page-content">
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold">Hasil Perhitungan Suara</h2>
            <h5 class="text-muted">{{ $election->title }}</h5>
        </div>
        <a href="{{ route('admin.votes.index') }}" class="btn btn-secondary">&larr; Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Grafik Perolehan Suara</div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <canvas id="voteChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Rincian Angka</div>
                <div class="card-body">
                    <div class="alert alert-info py-2">
                        <strong>Total Suara Masuk:</strong> {{ $totalVotes }} Suara
                    </div>
                    
                    <table class="table table-bordered table-striped align-middle">
                        <thead>
                            <tr>
                                <th>Kandidat</th>
                                <th class="text-center">Jumlah Suara</th>
                                <th class="text-center">Persentase</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($election->candidates as $candidate)
                            @php
                                $percentage = $totalVotes > 0 ? ($candidate->votes_count / $totalVotes) * 100 : 0;
                            @endphp
                            <tr>
                                <td>{{ $candidate->name }}</td>
                                <td class="text-center fw-bold">{{ $candidate->votes_count }}</td>
                                <td class="text-center">{{ number_format($percentage, 2) }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div></main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gunakan tag PHP native agar VS Code tidak bingung
    const myLabels = <?php echo json_encode($chartLabels); ?>;
    const myData = <?php echo json_encode($chartData); ?>;

    const ctx = document.getElementById('voteChart').getContext('2d');
    const voteChart = new Chart(ctx, {
        type: 'doughnut', 
        data: {
            labels: myLabels, 
            datasets: [{
                label: 'Jumlah Suara',
                data: myData,
                backgroundColor: [
                    '#3b82f6', '#ef4444', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
