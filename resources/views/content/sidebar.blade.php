<div class="card">
  <div class="card-body">
    <div class="mb-1 border-bottom">
      <div class="bg-success bg-gradient text-dark p-1 fs-4 mb-1 justify-content-start">
        <i class="fa-solid fa-volume-high"></i> &nbsp; Pengumuman
      </div>
      <div class="card-text">
        <p>Tidak ada data untuk ditampilkan</p>
      </div>
    </div>
    <div class="mb-1 border-bottom">
      <ul class="nav nav-tabs nav-justified" id="myTab2" role="tablist">
        <li class="nav-item">
          <button
            class="nav-link tabsBtn active"
            id="home-tab-justified"
            data-bs-toggle="tab"
            href="#home-just"
            role="tab"
            aria-controls="home-just"
            aria-selected="true"
            >Berita</button
          >
        </li>
        <li class="nav-item">
          <button
            class="nav-link tabsBtn"
            id="profile-tab-justified"
            data-bs-toggle="tab"
            href="#profile-just"
            role="tab"
            aria-controls="profile-just"
            aria-selected="true"
            >Agenda</button
          >
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content pt-1">
        <div class="tab-pane active" id="home-just" role="tabpanel" aria-labelledby="home-tab-justified">
          @for($i=0;$i<=2;$i++)
          <div class="border-bottom mb-1 pb-3">
            <a href="">
              <img class="img-thumbnail float-start me-1" width="100" src="https://pixinvent.com/demo/vuexy-html-bootstrap-admin-template/app-assets/images/slider/10.jpg" alt="Third slide">
            </a>
            <h3 class="fs-6"><a href="" class="text-dark">Disini judul artikelnya</a></h3>
            <div class="text-secondary small">
              <i class="fa-solid fa-clock"></i> Ahad, 31 Agustus 2022
            </div>
            
          </div>
          @endfor
        </div>
        <div class="tab-pane" id="profile-just" role="tabpanel" aria-labelledby="profile-tab-justified">
          <p>Tidak ada data untuk ditampilkan</p>
        </div>
      </div>
    </div>
    <div class="mb-1 border-bottom">
      <div class="bg-success bg-gradient text-dark p-1 fs-4 mb-1 justify-content-start">
        <i class="fa-solid fa-square-poll-vertical"></i> &nbsp; Jajak Pendapat
      </div>
      <div class="card-text">
        <p>Tidak ada data untuk ditampilkan</p>
      </div>
    </div>
    <div class="mb-1 border-bottom">
      <div class="bg-success bg-gradient text-dark p-1 fs-4 mb-1 justify-content-start">
        <i class="fa-solid fa-square-poll-vertical"></i> &nbsp; Statistik Pengunjung
      </div>
      <table class="table">
        <tr>
          <td>Hari ini</td>
          <td>:</td>
          <td>100</td>
        </tr>
        <tr>
          <td>Total</td>
          <td>:</td>
          <td>100</td>
        </tr>
        <tr>
          <td>Online</td>
          <td>:</td>
          <td>100</td>
        </tr>
      </table>
    </div>
  </div>
</div>