<header class="top-header">
    <nav class="navbar navbar-expand justify-content-between">
        
        {{-- Tombol Toggle Menu --}}
        <div class="btn-toggle-menu" style="cursor: pointer;">
            <span class="material-symbols-outlined">menu</span>
        </div>

        {{-- Search Bar (Desktop) --}}
        <div class="position-relative search-bar d-lg-block d-none">
            {{-- Pastikan route 'admin.elections.index' sudah ada di web.php --}}
            <form action="{{ route('admin.elections.index') }}" method="GET"> 
                <input 
                    class="form-control form-control-sm rounded-5 px-5" 
                    type="search" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Cari data..."
                    aria-label="Search"
                >
                <span class="material-symbols-outlined position-absolute ms-3 translate-middle-y start-0 top-50">search</span>
            </form>
        </div>

        {{-- Search Icon (Mobile) --}}
        <ul class="navbar-nav top-right-menu gap-2">
            <li class="nav-item d-lg-none d-block">
                <a class="nav-link" href="javascript:;" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <span class="material-symbols-outlined">search</span>
                </a>
            </li>
        </ul>

    </nav>
</header>