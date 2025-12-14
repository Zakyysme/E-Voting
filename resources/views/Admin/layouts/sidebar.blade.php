<aside class="sidebar-wrapper">
    <div class="sidebar-header">
        <div class="logo-icon">
            {{-- Pastikan file logo ada di public/assets/images --}}
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-img" alt="Logo">
        </div>
        <div class="logo-name flex-grow-1">
            <h5 class="mb-0">E-Voting App</h5>
        </div>
        <div class="sidebar-close">
            <span class="material-symbols-outlined">close</span>
        </div>
    </div>

    <div class="sidebar-nav" data-simplebar="true">
        <ul class="metismenu" id="menu">

            {{-- 1. DASHBOARD --}}
            {{-- Menyala hanya jika di halaman dashboard --}}
            <li class="{{ request()->routeIs('admin.dashboard') ? 'mm-active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i data-feather="sliders"></i>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>

            <li class="menu-label">Manajemen Data</li>

            {{-- 2. DATA MASTER (Parent Menu) --}}
            {{-- Menyala jika user membuka halaman Election, Candidate, atau Voter --}}
            <li class="{{ request()->routeIs('admin.elections.*', 'admin.candidates.*', 'admin.voters.*') ? 'mm-active' : '' }}">
                <a href="javascript:;" class="has-arrow">
                    <i data-feather="database"></i>
                    <div class="menu-title">Data Master</div>
                </a>
                <ul>
                    {{-- Data Election --}}
                    <li class="{{ request()->routeIs('admin.elections.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.elections.index') }}">
                            <i data-feather="edit"></i>
                            <div class="menu-title">Data Election</div>
                        </a>
                    </li>
                    
                    {{-- Data Kandidat --}}
                    <li class="{{ request()->routeIs('admin.candidates.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.candidates.index') }}">
                            <i data-feather="user"></i>
                            <div class="menu-title">Data Kandidat</div>
                        </a>
                    </li>
                    
                    {{-- Data Pemilih (DPT) --}}
                    <li class="{{ request()->routeIs('admin.voters.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.voters.index') }}">
                            <i data-feather="users"></i>
                            <div class="menu-title">Daftar Pemilih (DPT)</div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-label">Voting & Laporan</li>

            {{-- 3. LAPORAN & AUDIT (Parent Menu) --}}
            {{-- Menyala jika user membuka halaman Real Count atau Audit Log --}}
            <li class="{{ request()->routeIs('admin.votes.*', 'admin.audit_logs.*') ? 'mm-active' : '' }}">
                <a href="javascript:;" class="has-arrow">
                    <i data-feather="archive"></i>
                    <div class="menu-title">Hasil</div>
                </a>
                <ul>
                    {{-- Real Count (Grafik) --}}
                    <li class="{{ request()->routeIs('admin.votes.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('admin.votes.index') }}">
                            <i data-feather="inbox"></i>
                            <div class="menu-title">Real Count</div>
                        </a>
                    </li>
                </ul>
            </li>

             <li>
                <a href="#">
                    <i data-feather="settings"></i>
                    <div class="menu-title">Pengaturan Bilik</div>
                </a>
            </li>

            {{-- 4. LOGOUT (Menu Utama) --}}
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i data-feather="log-out"></i>
                    <div class="menu-title">Keluar</div>
                </a>
                {{-- Form Logout Tersembunyi --}}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>

    {{-- FOOTER SIDEBAR (Profile Singkat) --}}
    <div class="sidebar-bottom dropdown dropup-center dropup">
        <div class="dropdown-toggle d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
            <div class="user-img">
                {{-- Tampilkan Avatar User atau Default jika null --}}
                <img src="{{ Auth::user()->avatar ?? asset('assets/images/avatars/01.png') }}" alt="">
            </div>
            <div class="user-info">
                <h5 class="mb-0 user-name">{{ Auth::user()->name ?? 'Guest' }}</h5>
                <p class="mb-0 user-designation">{{ Auth::user()->role ?? 'Admin' }}</p>
            </div>
        </div>

        <ul class="dropdown-menu dropdown-menu-end">
            <li>
                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                    <span class="material-symbols-outlined me-2">account_circle</span> Profile
                </a>
            </li>
            <li>
                {{-- Logout via Dropdown --}}
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="material-symbols-outlined me-2">logout</span> Logout
                </a>
            </li>
        </ul>
    </div>
</aside>