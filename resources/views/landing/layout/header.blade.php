<!--=== Start Header Area ===-->
<header class="header-area header-one">
    <div class="header-navigation">
        <div class="container-fluid">
            <div class="primary-menu">
                <div class="site-branding">
                    <a href="index.html" class="brand-logo"><img src="" /></a>
                </div>

                <div class="theme-nav-menu">
                    <div class="theme-menu-top d-block d-xl-none">
                        <div class="site-branding">
                            <a href="index.html" class="brand-logo"><img src="" /></a>
                        </div>
                    </div>

                    <nav class="main-menu">
                        <ul>
                            <li class="menu-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="menu-item"><a href="{{ url('/about') }}">About</a></li>
                            <li class="menu-item"><a href="{{ url('/pemilihan') }}">Pemilihan</a></li>
                            <li class="menu-item"><a href="{{ url('/contact') }}">Contact</a></li>
                        </ul>
                    </nav>

                    <div class="theme-nav-button mt-20 d-block d-md-none">
                        <a href="{{ route('contact') }}" class="theme-btn style-one"> Get A Quote <i
                                class="far fa-arrow-right"></i></a>
                    </div>

                    <div class="theme-menu-bottom mt-50 d-block d-xl-none">
                        <h5>Follow Us</h5>
                        <ul class="social-link">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>

                @auth
                    <div class="nav-right-item">
                        <div class="nav-button d-none d-md-block d-flex align-items-center">
                            <span class="me-3" style="font-weight: bold; margin-right: 15px;">
                                {{ Auth::user()->name }}
                            </span>
                            
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="theme-btn style-one" style="padding: 10px 20px; font-size: 14px;">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="nav-right-item">
                        <div class="nav-button d-none d-md-block">
                            <a href="{{ route('login') }}" class="theme-btn style-one">Login</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
<!--=== End Header Area ===-->