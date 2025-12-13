<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.header')
</head>

<body>

    <!-- Sidebar -->
    
    <!-- Main content -->
    <div class="main-content">
        
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        
        @include('admin.layouts.sidebar')
        <!-- Page content -->
        <div class="container-fluid py-4">
            @yield('content')
        </div>

        @include('admin.layouts.footer')
    </div>

    @stack('scripts')
</body>

</html>