@extends('admin.layouts.main')

@section('title', 'Dashboard E-Voting')

@section('content')
<div class="page-content">
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">User Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                {{-- Menampilkan Foto atau Default Avatar --}}
                                <img src="{{ $user->foto ? asset('storage/photos/'.$user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0D8ABC&color=fff' }}" 
                                     alt="Admin" class="rounded-circle p-1 bg-primary" width="110" height="110" style="object-fit: cover;">
                                
                                <div class="mt-3">
                                    <h4>{{ $user->name }}</h4>
                                    <p class="text-secondary mb-1">Administrator</p>
                                    <p class="text-muted font-size-sm">{{ $user->email }}</p>
                                </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">Bergabung Sejak</h6>
                                    <span class="text-secondary">{{ $user->created_at->format('d M Y') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    
                    @if(session('success'))
                        <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="font-35 text-white"><span class="material-symbols-outlined">check_circle</span></div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-white">Sukses</h6>
                                    <div class="text-white">{{ session('success') }}</div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                            <div class="d-flex align-items-center">
                                <div class="font-35 text-white"><span class="material-symbols-outlined">error</span></div>
                                <div class="ms-3">
                                    <h6 class="mb-0 text-white">Error</h6>
                                    <div class="text-white">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <ul class="nav nav-pills mb-3" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="pill" href="#edit-profile" role="tab" aria-selected="true">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><span class="material-symbols-outlined me-2">person</span></div>
                                            <div class="tab-title">Edit Profil</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="pill" href="#change-password" role="tab" aria-selected="false">
                                        <div class="d-flex align-items-center">
                                            <div class="tab-icon"><span class="material-symbols-outlined me-2">lock</span></div>
                                            <div class="tab-title">Ganti Password</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="pills-tabContent">
                                
                                {{-- TAB 1: FORM EDIT DATA --}}
                                <div class="tab-pane fade show active" id="edit-profile" role="tabpanel">
                                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-3"><h6 class="mb-0">Foto Profil</h6></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="file" name="foto" class="form-control">
                                                <small class="text-muted">Format: jpg, png. Max: 2MB</small>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3"><h6 class="mb-0">Nama Lengkap</h6></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" />
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                {{-- TAB 2: FORM GANTI PASSWORD --}}
                                <div class="tab-pane fade" id="change-password" role="tabpanel">
                                    <form action="{{ route('admin.profile.password') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <div class="row mb-3">
                                            <div class="col-sm-3"><h6 class="mb-0">Password Lama</h6></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="current_password" class="form-control" placeholder="Masukkan password saat ini"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3"><h6 class="mb-0">Password Baru</h6></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter"/>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3"><h6 class="mb-0">Konfirmasi Password</h6></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password baru"/>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <button type="submit" class="btn btn-warning px-4">Ubah Password</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection