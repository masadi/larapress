<?php

use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Semester;

function tautan(){
    $tautan = [
        [
            [
                'link' => 'https://kemdikbud.go.id/',
                'title' => 'Kemdikbudristek RI',
            ],
            [
                'link' => 'https://paudpedia.kemdikbud.go.id/',
                'title' => 'Direktorat PAUD',
            ],
            [
                'link' => 'https://ditpsd.kemdikbud.go.id/',
                'title' => 'Direktorat SD',
            ],
            [
                'link' => 'https://ditsmp.kemdikbud.go.id/',
                'title' => 'Direktorat SMP',
            ],
            [
                'link' => 'https://sma.kemdikbud.go.id/',
                'title' => 'Direktorat SMA',
            ],
        ],
        [
            [
                'link' => 'https://kemenag.go.id/',
                'title' => 'Kemenag RI',
            ],
            [
                'link' => 'https://www.pendis.kemenag.go.id/',
                'title' => 'Ditjen Pendis',
            ],
            [
                'link' => 'http://ditpdpontren.kemenag.go.id/',
                'title' => 'Ditjen PD-Pontren',
            ],
            [
                'link' => 'https://nu.or.id/',
                'title' => 'NU Online',
            ],
            [
                'link' => 'https://sidogiri.net/',
                'title' => 'Sidogiri Online',
            ],
        ]
    ];
    return $tautan;
}
function first_image($post) {
    if($post->images->count()){
        $first_img = $post->images[0]->url;
    } else {
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->content, $matches);
        $first_img = ($matches[1]) ? $matches[1][0] : asset('images/no-image.jpg');
    }
  
    //if(empty($first_img)){ //Defines a default image
      //$first_img = "/images/default.jpg";
    //}
    return $first_img;
}
function categories(){
    return Category::withCount('posts')->get();
}
function tags(){
    return Tag::all();
}
function recent_post(){
    return Post::orderBy('created_at', 'DESC')->where('type', 'post')->take(5)->get();
}
function pages($slug){
    $posts = Post::whereHas('category', function($query) use ($slug){
        $query->where('slug', $slug);
    })->where('type', 'page')->get();
    $menu = [];
    foreach($posts as $post){
        $menu[] = [
            'name' => $post->title,
            'url' => route('page', ['page' => $post->slug]),
        ];
    }
    return $menu;
}
function pekerjaan(){
    $pekerjaan = [
        1 => "Tidak bekerja",
        2 => "Nelayan",
        3 => "Petani",
        4 => "Peternak",
        5 => "PNS/TNI/Polri",
        6 => "Karyawan Swasta",
        7 => "Pedagang Kecil",
        8 => "Pedagang Besar",
        9 => "Wiraswasta",
        10 => "Wirausaha",
        11 => "Buruh",
        12 => "Pensiunan",
        13 => "Tenaga Kerja Indonesia",
        14 => "Karyawan BUMN",
        90 => "Tidak dapat diterapkan",
        98 => "Sudah Meninggal",
        99 => "Lainnya",
    ];
    return $pekerjaan;
}
function get_pekerjaan($id){
    $pekerjaan = pekerjaan();
    return $pekerjaan[$id];
}
function jenis_pendaftaran($id){
    $jenis_pendaftaran = [
        1 => "Siswa baru",
        2 => "Pindahan",
        3 => "Naik kelas",
        5 => "Mengulang",
        6 => "Lanjutan semester",
        7 => "Kembali bersekolah",
        9 => "Putus Sekolah",
    ];
    return $jenis_pendaftaran[$id];
}
function sinkronisasi($sekolah, $satuan){
    $data_sync = [
        'username_dapo'		=> $sekolah->email,
        'npsn'				=> $sekolah->npsn,
        'tahun_ajaran_id'	=> get_semester()['tahun_ajaran_id'],
        'semester_id'		=> get_semester()['semester_id'],
        'sekolah_id'		=> $sekolah->sekolah_id,
        //'updated_at'        => ($updated_at) ? Carbon::parse($updated_at)->format('Y-m-d H:i:s') : NULL,
        //'last_sync'         => NULL,
    ];
    $response = Http::withHeaders([
        'x-api-key' => $sekolah->sekolah_id,
    ])->withBasicAuth('admin', '1234')->asForm()->post('http://103.40.55.242/erapor_server/api/'.$satuan, $data_sync);
    if($response->status() == 200){
        return $response->object();
    } else {
        return false;
    }
}
function get_semester(){
    if(session('tahun_ajaran_id')){
        $tahun_ajaran_id = session('tahun_ajaran_id');
        $semester_id = session('semester_id');
    } else {
        $semester = Semester::where('periode_aktif', 1)->first();
        $tahun_ajaran_id = $semester->tahun_ajaran_id;
        $semester_id = $semester->semester_id;
    }
    return [
        'tahun_ajaran_id' => $tahun_ajaran_id,
        'semester_id' => $semester_id,
    ];
}