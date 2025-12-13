@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
    <main class="page-content">

        {{-- Ringkasan Statistik E-Voting --}}
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-xl-4">

            {{-- Card 1: Total Suara Masuk (Ganti dari Total Orders) --}}
            <div class="col">
                <div class="card radius-10 border-0 border-start border-primary border-4">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <p class="mb-1">Total Suara Masuk</p>
                            <h4 class="mb-0 text-primary">{{ $totalVotes }}</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-primary text-white">
                            {{-- Icon Kotak Suara --}}
                            <i class="bi bi-box-seam"></i> 
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Persentase Partisipasi (Ganti dari Total Revenue) --}}
            <div class="col">
                <div class="card radius-10 border-0 border-start border-success border-4">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <p class="mb-1">Partisipasi Pemilih</p>
                            <h4 class="mb-0 text-success">
                                {{-- Menghitung persentase --}}
                                {{ $totalVoters > 0 ? number_format(($totalVotes / $totalVoters) * 100, 1) : 0 }}%
                            </h4>
                        </div>
                        <div class="ms-auto widget-icon bg-success text-white">
                            {{-- Icon Grafik Pie --}}
                            <i class="bi bi-pie-chart-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 3: Total Kandidat (Ganti dari Total Products) --}}
            <div class="col">
                <div class="card radius-10 border-0 border-start border-danger border-4">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <p class="mb-1">Total Kandidat</p>
                            <h4 class="mb-0 text-danger">{{ $totalCandidates }}</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-danger text-white">
                            {{-- Icon Orang/Kandidat --}}
                            <i class="bi bi-person-video2"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 4: Daftar Pemilih Tetap/DPT (Ganti dari Total Users) --}}
            <div class="col">
                <div class="card radius-10 border-0 border-start border-warning border-4">
                    <div class="card-body d-flex align-items-center">
                        <div>
                            <p class="mb-1">Total DPT (Pemilih)</p>
                            <h4 class="mb-0 text-warning">{{ $totalVoters }}</h4>
                        </div>
                        <div class="ms-auto widget-icon bg-warning text-dark">
                            {{-- Icon User Group --}}
                            <i class="bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Tabel Aktivitas Voting Terkini (Ganti dari Latest Orders) --}}
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Aktivitas Voting Terkini</h5>

                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Pemilih</th>
                                <th>NIM/Identitas</th>
                                <th>Status Suara</th>
                                <th>Waktu Voting</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop Data Voting Terbaru --}}
                            @forelse ($recentActivities as $activity)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    {{-- Kolom Nama Pemilih --}}
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            {{-- Avatar dummy atau dari database --}}
                                            <img src="{{ $activity->user->avatar ?? '/assets/images/avatars/01.png' }}" 
                                                 class="rounded-circle" width="40" height="40" alt="User">
                                            <span class="fw-bold">{{ $activity->user->name }}</span>
                                        </div>
                                    </td>

                                    {{-- Kolom Identitas (NIM/NIK) --}}
                                    <td>{{ $activity->user->identity_number ?? '-' }}</td>

                                    {{-- Kolom Status --}}
                                    <td>
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i> Berhasil Memilih
                                        </span>
                                    </td>

                                    {{-- Kolom Waktu --}}
                                    <td>{{ $activity->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Belum ada suara yang masuk.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </main>
@endsection