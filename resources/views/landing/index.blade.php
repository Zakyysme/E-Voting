@extends('landing.layout.app')

@section('title', 'Home')

@section('content')

<!--====== Start Hero Section ======-->
<section class="bizzen-hero">
    <div class="bizzen-hero_one bg_cover" style="background-image: url(landing/images/home-one/hero/hero-bg.jpg);">
        <div class="hero-bg-shape"></div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="hero-content">
                        <span class="sub-title" data-aos="fade-down" data-aos-duration="1000">Electronic Voting</span>
                        <h1 class="text-anm">Pemilihan Umum Calon Presiden Indonesia <span><img src="" alt="2024" /></span></h1>
                        <div class="hero-button" data-aos="fade-up" data-aos-duration="1400">
                            <a href="contact.html" class="theme-btn style-one">Hubungi Kami<i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="text-box mb-5 mb-xl-0" data-aos="fade-up" data-aos-duration="1000">
                        <div class="avatar-list">
                            <img src="landing/images/home-one/hero/Anies.jpg" alt="avatar" />
                            <img src="landing/images/home-one/hero/images.jpg" alt="avatar" />
                            <img src="landing/images/home-one/hero/Prabowo.webp" alt="avatar" />
                        </div>
                        <h4>Tentukan <span>Pilihanmu Dengan Benar</span></h4>
                        <p>Selamat datang di era baru demokrasi digital Indonesia. Melalui sistem E-Voting ini, Anda dapat memberikan suara secara lebih cepat, aman, dan transparan. Teknologi hadir untuk memastikan proses pemilihan berjalan secara jujur, efisien, dan dapat dipertanggungjawabkan.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="hero-image text-center" data-aos="fade-up" data-aos-duration="1200">
                        <img src="landing/images/home-one/hero/hero-img1.jpg" alt="hero image" />
                        <div>
                            <h2></h2>
                            <div class="ratings"></div>
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Hero Section ======-->

<!--====== Start Service Section ======-->
<section class="bizzen-service_one pt-115 pb-115 bg_cover" style="background-image: url(landing/images/home-one/bg/service-bg.png);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center mb-60">
                    <span class="sub-title" data-aos="fade-up" data-aos-duration="1000">PANDUAN PEMILIHAN</span>
                    <h2 class="text-anm">Pilih, Tentukan, dan Wujudkan Masa Depan Indonesia</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="bizzen-service-item style-one mb-30" data-aos="fade-up" data-aos-duration="1000">
                    <div class="service-inner-content">
                        <div class="icon">
                            <img src="landing/images/home-one/icon/icon1.svg" alt="icon" />
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="{{ route('pemilihan.index') }}">Masuk Pada Menu Pilih Calon</a></h4>
                            <p>Gunakan hak pilih Anda dengan bijak. Indonesia menunggu keputusanmu.</p>
                            <a href="{{ route('pemilihan.index') }}" class="read-more style-one">GET STARTED <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="bizzen-service-item style-one mb-30" data-aos="fade-up" data-aos-duration="1200">
                    <div class="service-inner-content">
                        <div class="icon">
                            <img src="landing/images/home-one/icon/icon2.svg" alt="icon" />
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="{{ route('pemilihan.index') }}">Pilih Calon Pemimpin</a></h4>
                            <p>Pemimpin dipilih oleh rakyat. Kini giliran Anda untuk memilih pemimpin yang tepat.</p>
                            <a href="{{ route('pemilihan.index') }}" class="read-more style-one">GET STARTED <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="bizzen-service-item style-one mb-30" data-aos="fade-up" data-aos-duration="1400">
                    <div class="service-inner-content">
                        <div class="icon">
                            <img src="landing/images/home-one/icon/icon3.svg" alt="icon" />
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="{{ route('pemilihan.index') }}">Klik Button Pilih</a></h4>
                            <p>Seteah menentukan pilahan anda, silahkan klik buttin pilih untuk memilih calon pemimpin.</p>
                            <a href="{{ route('pemilihan.index') }}" class="read-more style-one">GET STARTED <i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== End Service Section ======-->
@endsection