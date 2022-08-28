<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta name="author" content="Mas Adi">
  <title>@yield('title') | {{config('app.name')}}</title>
  <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon/favicon-16x16.png">
  <link rel="manifest" href="/images/favicon/site.webmanifest">
  <link rel="mask-icon" href="/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  @stack('styles')
  @livewireStyles
  <!-- =======================================================
  * Template Name: Yayasan Darul Karomah - v1.10.1
  * Template URL: https://bootstrapmade.com/Yayasan Darul Karomah-bootstrap-startup-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
  @include('panels/header')
  @yield('hero')
  <main id="main">
    @if(Route::currentRouteName() == 'home')
      @yield('content')
    @else
      @yield('breadcrumbs')
      {{--@include('panels/breadcrumbs')--}}
      <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">
          <div class="row">
            <div class="col-lg-8 entries">
              @if(Route::currentRouteName() == 'page')
              <article class="entry">
                @yield('entry-meta')
                <div class="entry-content">
                  @yield('content')
                </div>
              </article>
              @elseif(Route::currentRouteName() == 'cari' || Route::currentRouteName() == 'kategori' || Route::currentRouteName() == 'tag')
              @yield('content')
              @else
              <article class="entry entry-single">
                @yield('entry-meta')
                <div class="entry-content">
                  @yield('content')
                </div>
                @yield('entry-footer')
              </article>
              @yield('blog-author')
              @yield('comments')
              @endif
            </div>
            <div class="col-lg-4">
              @include('panels/sidebars')
            </div>
          </div>
        </div>
      </section>
    @endif
  </main>
  <footer id="footer" class="footer">
    <?php $tautan = tautan() ?>
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <img src="{{asset('assets/img/logo.png')}}" alt="">
              <span>Yayasan Darul Karomah</span>
            </a>
            <p>Komplek Pon-Pes Darul Karomah Dusun Bicabbi 1 Desa Larangan Luar Kec. Larangan Kab. Pamekasan 69384.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Tautan I</h4>
            <ul>
              @foreach ($tautan[0] as $item)
              <li><i class="bi bi-chevron-right"></i> <a href="{{$item['link']}}" target="_blank">{{$item['title']}}</a></li>    
              @endforeach
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Tautan II</h4>
            <ul>
              @foreach ($tautan[1] as $item)
              <li><i class="bi bi-chevron-right"></i> <a href="{{$item['link']}}" target="_blank">{{$item['title']}}</a></li>    
              @endforeach
            </ul>
          </div>

          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Video</h4>
            <iframe src="https://www.youtube.com/embed/j78jIbOH9D0" title="SEMARAK IDUL ADHA DI PON-PES DARUL KAROMAH" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <a href="hhttps://cyberelectra.co.id/" target="_blank"><strong>Cyber Electra &trade;</strong></a>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/Yayasan Darul Karomah-bootstrap-startup-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>
  @stack('scripts')
  @livewireScripts
  <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <x-livewire-alert::scripts />
</body>
</html>
