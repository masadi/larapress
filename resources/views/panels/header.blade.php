{{--
<header class="py-1 bg-success bg-gradient">
  <div class="container d-flex flex-wrap justify-content-start">
    <div class="col-12 col-lg-auto mb-md-0 text-sm-center text-lg-start">
      <a href="/" class="me-1">
        <img src="https://darmah.mas-adi.net/vendor/img/logo.png" alt="" class="img-responsive" width="104">
      </a>
    </div>
    <div class="col-12 col-lg-auto mb-md-0 d-none d-sm-block text-sm-center text-lg-start">
      <h1 class="text-dark"><span class="d-none d-md-block">Yayasan Darul Karomah</span></h1>
      <h2 class="text-dark"><strong>Akta Notaris : R. Ahmad Ramali, SH. No. 24 Tanggal 13 Februari 2014</strong></h2>
      <p class="text-dark">Komplek Pon-Pes Darul Karomah Dusun Bicabbi 1 Desa Larangan Luar Kec. Larangan Kab. Pamekasan Telp. 0818xxxxxx Kode Pos 69383</p>
    </div>
  </div>
</header>
--}}
<header id="header" class="header fixed-top">
  <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
    <a href="{{url('/')}}" class="logo d-flex align-items-center">
      <img src="{{asset('images/logo.png')}}" alt="Logo" class="rounded">
      <span class="d-none d-xl-block">{{config('app.name')}}</span>
      <span class="d-none d-sm-block d-xl-none">{{config('app.name')}}</span>
    </a>
    <nav id="navbar" class="navbar">
      {!! $NavbarUtama->asUl([], ['class' => 'dropdown']) !!}
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->
  </div>
</header><!-- End Header -->