<!DOCTYPE html>
<html lang="en">

<head>
    @include('landing.layout.head')
</head>

<body>

    <!--====== Start Preloader ======-->
    <div class="preloader">
        <div class="loading-wrapper">
            <div class="loading"></div>
            <div id="loading-icon">
                <img src="landing/images/loader.png" alt="loader" />
            </div>
        </div>
    </div>
    <!--====== End Preloader ======-->

    <!--====== Start Overlay ======-->
    <div class="offcanvas__overlay"></div>

    {{-- Header / Navbar --}}
    @include('landing.layout.header')

    {{-- Content --}}
    <div id="smooth-wrapper">
        <div id="smooth-content">
            <main>
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('landing.layout.footer')
        </div>
    </div>

    {{-- Script --}}
    @include('landing.layout.scripts')
</body>

</html>