<div id="carousel-bottom" class="carousel slide bg-primary d-none d-md-block" data-bs-ride="carousel">
    <div class="container carousel-inner py-2">
      <div class="carousel-item active" data-bs-interval="100000">
        <div class="row">
          @for($i=0;$i<=3;$i++)
          <div class="col-3">
            <div class="card">
              <div class="card-body">
                <img class="float-start me-1" width="100" src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/slider/09.jpg" alt="First slide">
                <p>{{date('d-m-Y')}} <br> Kegiatan di sumenep</p>
              </div>
            </div>
          </div>
          @endfor
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="100000">
        <div class="row">
          @for($i=0;$i<=3;$i++)
          <div class="col-3">
            <div class="card">
              <div class="card-body">
                <img class="float-start me-1" width="100" src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/slider/09.jpg" alt="First slide">
                <p>{{date('d-m-Y')}} <br> Kegiatan di sumenep</p>
              </div>
            </div>
          </div>
          @endfor
        </div>
      </div>
      <div class="carousel-item" data-bs-interval="100000">
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <img class="float-start me-1" width="100" src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/slider/09.jpg" alt="First slide">
              <p>{{date('d-m-Y')}} <br> Kegiatan di sumenep</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-black text-light">
    <div class="container border-bottom">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3 py-2">
          <img src="{{asset('images/logo.png')}}" alt="asd" class="img-responsive float-start me-1" width="50">
          <h4 class="fs-5 text-light">Yayasan Darul Karomah</h4>
          <h5 class="fs-6 text-light">Kabupaten Pamekasan</h5>
          <div class="g-bg-no-repeat" style="background-image: url({{asset('images/map2.png')}});background-repeat: no-repeat;">
            <p> Komplek PP. Darul Karomah Dusun Bicabbi 1 Desa Larangan Luar Kec. Larangan Kab. Pamekasan</p>
            <p>Email : info@ariyametta.sch.id</p>
            <p>Telepon/Fax : Telp. (021 )5523186, 55794245, 5587134</p>
          </div>
          <ul class="list-inline">
            <li class="list-inline-item"><a href="" class="text-light"><i class="fa-brands fa-square-facebook"></i></a></li>
            <li class="list-inline-item"><a href="" class="text-light"><i class="fa-brands fa-square-instagram"></i></a></li>
            <li class="list-inline-item"><a href="" class="text-light"><i class="fa-brands fa-square-twitter"></i></a></li>
            <li class="list-inline-item"><a href="" class="text-light"><i class="fa-brands fa-square-youtube"></i></a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3 d-none d-lg-block py-2">
          <h1 class="fs-5 text-light">TERPOPULER</h1>
          @for($i=0;$i<=2;$i++)
          <div class="border-bottom-dark mb-1 pb-3">
            <img class="img-thumbnail float-start me-1" width="100" src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/slider/10.jpg" alt="Third slide">
            <div class="text-secondary small">
              <i class="fa-solid fa-clock"></i> Ahad, 31 Agustus 2022 &nbsp;&nbsp; 
              <i class="fa-solid fa-eye"></i> 100 &nbsp;&nbsp; 
            </div>
            <h3 class="fs-6"><a href="" class="text-light">Disini judul artikelnya</a></h3>
          </div>
          @endfor
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 d-none d-lg-block py-2">
          <h1 class="fs-5 text-light">TAUTAN</h1>
          <ul class="p-0">
            @foreach (tautan() as $tautan)
            <li class="d-flex align-items-center">
              <i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;
              <a href="{{$tautan['link']}}" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" class="link-light" title="{{$tautan['title']}}">{{$tautan['title']}}</a>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-3 py-2">
          <h1 class="fs-5 text-light">VIDEO</h1>
          <div class="ratio ratio-16x9 mb-1">
            <iframe src="https://www.youtube.com/embed/j78jIbOH9D0" title="SEMARAK IDUL ADHA DI PON-PES DARUL KAROMAH"></iframe>
          </div>
          <button type="button" class="btn btn-sm btn-warning float-end"><i class="fa-solid fa-circle-check"></i> Arsip Video</button>
        </div>
      </div>
    </div>
  </div>