@extends('landing.layout.app')

@section('content')
<!--======  Start Page Hero Section  ======-->
<section class="bizzen-hero_one bg_cover" style="
              background-image: url(landing/images/home-one/hero/hero-bg.jpg);
            ">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="page-content text-center">
          <h1 style="color: white">
            E-Vote Cepat, Aman, dan Transparan untuk Demokrasi
            Indonesia.
          </h1>
        </div>
      </div>
    </div>
  </div>
</section>
<!--======  End Page Hero Section  ======-->
<!--======  Start About Section  ======-->
<section class="bizzen-about_three pt-120">
  <div class="container">
    <!-- About Wrapper -->
    <div class="about-wrapper">
      <div class="row">
        <div class="col-lg-5">
          <!--=== Bizzen Item List ===-->
          <div class="bizzen-item-list">
            <div class="bizzen-iconic-item style-one" data-aos="fade-up" data-aos-duration="800">
              <div class="icon">
                <img src="landing/images/innerpage/icon/icon1.svg" alt="icon" />
              </div>
              <div class="content">
                <h4>Misi</h4>
                <p>
                  Misi kami adalah membangun Indonesia yang sejahtera
                  melalui pemerataan ekonomi, peningkatan kualitas
                  pendidikan, dan layanan kesehatan yang mudah diakses
                  oleh seluruh masyarakat. Kami berkomitmen memperkuat
                  infrastruktur dan transformasi digital untuk
                  mendukung kemajuan bangsa, serta menjalankan
                  pemerintahan yang transparan, bersih, dan bebas
                  korupsi. Selain itu, kami berupaya menjaga
                  kelestarian lingkungan dan memperkuat persatuan
                  nasional sebagai landasan pembangunan berkelanjutan
                  bagi generasi mendatang.
                </p>
              </div>
            </div>
            <div class="bizzen-iconic-item style-one" data-aos="fade-up" data-aos-duration="1000">
              <div class="icon">
                <img src="landing/images/innerpage/icon/icon2.svg" alt="icon" />
              </div>
              <div class="content">
                <h4>Visi.</h4>
                <p>
                  Mewujudkan Indonesia yang maju, adil, berkelanjutan,
                  dan berdaya saing global melalui pemerintahan
                  transparan, inklusif, serta berorientasi pada
                  kesejahteraan rakyat.
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <!--=== Bizzen Content Box ===-->
          <div class="bizzen-content-box">
            <div class="section-title">
              <span class="sub-title" data-aos="fade-down" data-aos-duration="800">About Us</span>
            </div>
            <p class="mb-4" data-aos="fade-up" data-aos-duration="1000">
              Sistem E-Voting ini dibuat sebagai sarana pemilihan
              Presiden Republik Indonesia secara digital, aman,
              transparan, dan efisien.
            </p>
            <p class="mb-4" data-aos="fade-up" data-aos-duration="1200">
              Platform ini dirancang untuk memastikan setiap warga
              negara dapat menggunakan hak pilihnya tanpa hambatan,
              dengan tingkat keamanan yang tinggi dan proses
              verifikasi yang akurat. Melalui teknologi ini, kami
              berharap dapat meningkatkan partisipasi masyarakat dalam
              proses demokrasi serta mendukung penyelenggaraan pemilu
              yang lebih modern, jujur, dan adil.
            </p>
            <div class="bizzen-button" data-aos="fade-up" data-aos-duration="1400">
              <a href="{{ route('contact') }}" class="theme-btn style-one">
                REQUEST A CALL BACK<i class="far fa-arrow-right"></i>
              </a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection