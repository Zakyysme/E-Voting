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
            Mari memilih dengan jujur, adil, dan bertanggung jawab.
          </h1>
        </div>
      </div>
    </div>
  </div>
</section>
<!--======  End Page Hero Section  ======-->
<!--======  Start Project Section  ======-->
<style>
  .project-thumbnail img {
    width: 500px;
    height: 500px;
    object-fit: cover;
    border-radius: 10px;
  }

  @media (max-width: 768px) {
    .project-thumbnail img {
      height: 220px;
    }
  }
</style>

<section class="bizzen-project-sec pt-120 pb-90">
  <div class="container">
    <div class="row">
      @foreach($elections as $election)
      <div class="col-lg-4 col-md-6">
        <div class="bizzen-project-item mb-30">
          <div class="project-thumbnail">
            <img src="{{ $election->logo ? asset('storage/' . $election->logo) : 'https://ui-avatars.com/api/?name='.urlencode($candidate->name) }}" />
            <div class="hover-content">
              <div class="project-content">
                <h4>
                  <a href="{{ route('pemilihan.show', $election->id) }}">{{ $election->title }}</a>
                </h4>
                <p class="text-white small">
    Berakhir pada: {{ \Carbon\Carbon::parse($election->end_at)->format('d M Y') }}
</p>
                <div class="category-button">
                  <a href="{{ route('pemilihan.show', $election->id) }}">Lihat Kandidat</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!--======  End Project Section  ======-->
@endsection