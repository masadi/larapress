<?php

namespace App\Http\Livewire\Referensi;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Sekolah;
use App\Models\Semester;
use App\Models\Ptk;
use App\Models\Ptk_terdaftar;
use App\Models\Peserta_didik;
use App\Models\Registrasi_pd;
use App\Models\Gelar;
use App\Models\Gelar_ptk;
use App\Models\Rombongan_belajar;
use App\Models\Mata_pelajaran;
use App\Models\Mata_pelajaran_sekolah;
use App\Models\Pembelajaran;
use App\Models\Anggota_rombel;
use App\Models\Wilayah;
use App\Models\Ekstrakurikuler;
use App\Models\Team;
use App\Models\Role;
use App\Models\User;

class DataSekolah extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortby = 'created_at';
    public $sortbydesc = 'DESC';
    public $per_page = 10;
    
    public $kementerian;
    public $showPagi = FALSE;
    public $showSore = FALSE;
    public $npsn;
    public $sekolah;
    public $satuan;

    public function render()
    {
        if($this->kementerian){
            if($this->kementerian == 1){
                $this->showPagi = TRUE;
            } else {
                $this->showSore = TRUE;
            }
        }
        return view('livewire.referensi.data-sekolah',[
            'collection' => Sekolah::withCount(['ptk', 'peserta_didik', 'rombongan_belajar' => function($query){
                $query->where('semester_id', $this->getSemester()->semester_id);
            }])->orderBy($this->sortby, $this->sortbydesc)
                ->when($this->search, function($query) {
                    $query->where('nama', 'ILIKE', '%' . $this->search . '%');
                    $query->orWhere('npsn', 'ILIKE', '%' . $this->search . '%');
                })->paginate($this->per_page),
        ]);
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function loadPerPage(){
        $this->resetPage();
    }
    private function reset_form(){
        $this->reset(['showPagi', 'showSore', 'kementerian', 'npsn']);
    }
    public function updatedKementerian(){
        if($this->kementerian){
            if($this->kementerian == 1){
                $this->showPagi = TRUE;
            } else {
                $this->showSore = TRUE;
            }
        }
    }
    public function store(){
        if($this->kementerian == 1){
            $this->sedot_sekolah();
        } else {

        }
        $this->reset_form();
        $this->kementerian = NULL;
        $this->emit('close-modal');
    }
    private function sedot_sekolah(){
        $sync_sekolah = Http::get('http://103.40.55.242/erapor_server/sync/get_sekolah/'.$this->npsn);
        $sekolah = json_decode($sync_sekolah->body());
        if(isset($sekolah->data[0])){
            $sekolah = $sekolah->data[0];
            $sekolah_id = strtolower($sekolah->sekolah_id);
            $new_sekolah = Sekolah::updateOrCreate(
                ['sekolah_id' => $sekolah_id],
                [
                    'npsn' => $sekolah->npsn,
                    'nama' => $sekolah->nama,
                    'bentuk_pendidikan_id' => $sekolah->bentuk_pendidikan_id,
                    'alamat' => $sekolah->alamat_jalan,
                    'kode_pos' => $sekolah->kode_pos,
                    'lintang' => $sekolah->lintang,
                    'bujur' => $sekolah->bujur,
                    'no_telp' => $sekolah->nomor_telepon,
                    'no_fax' => $sekolah->nomor_fax,
                    'email' => $sekolah->username,
                    'website' => $sekolah->website,
                ]
            );
            if($new_sekolah){
                $this->alert('success', 'Data Sekolah berhasil disimpan!');
            } else {
                $this->alert('error', 'Gagal. Silahkan coba lagi!');
            }
        } else {
            $this->alert('error', 'Server tidak merespon!');
        }
    }
    private function getRole($nama){
        $role = Role::where('name', $nama)->first();
        return $role;
    }
    private function getTeam($name){
        $team = Team::where('name', $name)->first();
        return $team;
    }
    public function syncData($satuan, $sekolah_id){
        $this->satuan = $satuan;
        $this->sekolah = Sekolah::find($sekolah_id);
        $dapodik = $this->ambil_data();
        $function = 'proses_'.$satuan;
        if($dapodik){
            $this->{$function}($dapodik);
            $this->alert('success', 'Sinkronisasi selesai');
        } else {
            $this->alert('error', 'Server tidak merespon!');
        }
    }
    public function ambil_data(){
        $data_sync = [
            'username_dapo'		=> $this->sekolah->email,
            'npsn'				=> $this->sekolah->npsn,
            'tahun_ajaran_id'	=> $this->getSemester()->tahun_ajaran_id,
            'semester_id'		=> $this->getSemester()->semester_id,
            'sekolah_id'		=> $this->sekolah->sekolah_id,
            //'updated_at'        => ($updated_at) ? Carbon::parse($updated_at)->format('Y-m-d H:i:s') : NULL,
            //'last_sync'         => NULL,
        ];
        $response = Http::withHeaders([
            'x-api-key' => $this->sekolah->sekolah_id,
        ])->withBasicAuth('admin', '1234')->asForm()->post('http://103.40.55.242/erapor_server/api/'.$this->satuan, $data_sync);
        if($response->status() == 200){
            return $response->object();
        } else {
            return false;
        }
    }
    private function getSemester(){
        $semester = Semester::where('periode_aktif', 1)->first();
        return $semester;
    }
    private function proses_ptk($dapodik){
        if($dapodik){
            foreach($dapodik->dapodik as $data){
                $kecamatan = Wilayah::find($data->wilayah->kode_wilayah);
                $kabupaten = Wilayah::find($data->wilayah->parrent_recursive->kode_wilayah);
                $provinsi = Wilayah::find($data->wilayah->parrent_recursive->parrent_recursive->kode_wilayah);
                if(!$provinsi){
                    $provinsi = Wilayah::create([
                        'kode_wilayah' => $data->wilayah->parrent_recursive->parrent_recursive->kode_wilayah,
                        'nama' => $data->wilayah->parrent_recursive->parrent_recursive->nama,
                        'id_level_wilayah' => $data->wilayah->parrent_recursive->parrent_recursive->id_level_wilayah,
                        'mst_kode_wilayah' => $data->wilayah->parrent_recursive->parrent_recursive->mst_kode_wilayah,
                    ]);
                }
                if(!$kabupaten){
                    $kabupaten = Wilayah::create([
                        'kode_wilayah' => $data->wilayah->parrent_recursive->kode_wilayah,
                        'nama' => $data->wilayah->parrent_recursive->nama,
                        'id_level_wilayah' => $data->wilayah->parrent_recursive->id_level_wilayah,
                        'mst_kode_wilayah' => $data->wilayah->parrent_recursive->mst_kode_wilayah,
                    ]);
                }
                if(!$kecamatan){
                    $kecamatan = Wilayah::create([
                        'kode_wilayah' => $data->wilayah->kode_wilayah,
                        'nama' => $data->wilayah->nama,
                        'id_level_wilayah' => $data->wilayah->id_level_wilayah,
                        'mst_kode_wilayah' => $data->wilayah->mst_kode_wilayah,
                    ]);
                }
                $desa = Wilayah::where('mst_kode_wilayah', $data->wilayah->kode_wilayah)->where('nama', $data->wilayah->nama)->first();
                $ptk = Ptk::updateOrCreate(
                    [
                        'ptk_id' => $data->ptk_id,
                    ],
                    [
                        'nama' => $data->nama,
                        'nuptk' => $data->nuptk,
                        'nip' => $data->nip,
                        'jenis_kelamin' => $data->jenis_kelamin,
                        'tempat_lahir' => $data->tempat_lahir,
                        'tanggal_lahir' => $data->tanggal_lahir,
                        'nik' => $data->nik,
                        'agama_id' => $data->agama_id,
                        'alamat' => $data->alamat_jalan,
                        'rt' => $data->rt,
                        'rw' => $data->rw,
                        'desa' => $desa ?? NULL,
                        'kecamatan' => $data->wilayah->kode_wilayah,
                        'kabupaten' => $data->wilayah->parrent_recursive->kode_wilayah,
                        'provinsi' => $data->wilayah->parrent_recursive->parrent_recursive->kode_wilayah,
                        'kode_pos' => $data->kode_pos,
                        'no_hp' => $data->no_hp,
                        'email' => $data->email,
                    ]
                );
                Ptk_terdaftar::firstOrCreate(
                    [
                        'ptk_terdaftar_id' => $data->ptk_terdaftar_id,
                    ],
                    [
                        'ptk_id' => $data->ptk_id,
                        'sekolah_id' => $data->sekolah_id,
                        'tahun_ajaran_id' => $data->tahun_ajaran_id,
                        'nomor_surat_tugas' => $data->nomor_surat_tugas,
                        'tmt_tugas' => $data->tmt_tugas,
                        'ptk_induk' => $data->ptk_induk,
                    ]
                );
                $this->create_user($data, 'ptk');
            }
        } else {
            $this->alert('error', 'Data kosong. Sekolah '.$this->sekolah->nama.' belum sinkron Dapodik');
        }
    }
    private function create_user($data, $role){
        if($role == 'ptk'){
            $id = ['ptk_id' => $data->ptk_id];
        } else {
            $id = ['peserta_didik_id' => $data->peserta_didik_id];
        }
        $user = User::firstOrCreate(
            $id,
            [
                'email' => ($data->email) ? $data->email : $this->generateEmail(),
                'name' => $data->nama,
                'password' => bcrypt('12345678'),
            ]
        );
        $team = $this->getTeam('tahun-ajaran-'.$this->getSemester()->tahun_ajaran_id);
        $role = $this->getRole($role);
        if(!$user->hasRole($role, $team)){
            $user->attachRole($role, $team);
        }
    }
    private function proses_rombongan_belajar($dapodik){
        if($dapodik->dapodik){
            foreach($dapodik->dapodik as $data){
                Rombongan_belajar::updateOrCreate(
                    [
                        'rombongan_belajar_id' => $data->rombongan_belajar_id,
                    ],
                    [
                        'sekolah_id' => $data->sekolah_id,
                        'semester_id' => $data->semester_id,
                        'nama' => $data->nama,
                        'tingkat_pendidikan_id' => $data->tingkat_pendidikan_id,
                        'ptk_id' => $data->ptk_id,
                    ]
                );
            }
        } else {
            $this->alert('error', 'Data kosong. Sekolah '.$this->sekolah->nama.' belum sinkron Dapodik');
        }
    }
    private function proses_ekstrakurikuler($dapodik){
        if($dapodik->dapodik){
            foreach($dapodik->dapodik as $data){
                Ekstrakurikuler::updateOrCreate(
                    [
                        'ekstrakurikuler_id' => $data->ID_kelas_ekskul,
                    ],
                    [
                        'rombongan_belajar_id' => $data->rombongan_belajar_id,
                        'sekolah_id' => $data->sekolah_id,
                        'semester_id' => $data->semester_id,
                        'nama' => $data->nm_ekskul,
                        'ptk_id' => $data->ptk_id,
                    ]
                );
            }
        } else {
            $this->alert('error', 'Data kosong. Sekolah '.$this->sekolah->nama.' belum sinkron Dapodik');
        }
    }
    private function proses_peserta_didik_aktif($dapodik){
        if($dapodik){
            foreach($dapodik->dapodik as $data){
                $wilayah = Wilayah::find($data->kode_wilayah);
                $desa = NULL;
                $kecamatan = NULL;
                $kabupaten = NULL;
                $provinsi = NULL;
                if($wilayah){
                    if($wilayah->id_level_wilayah == 3){
                        //proses dari kecamatan
                        $desa = Wilayah::where('mst_kode_wilayah', $data->kode_wilayah)->where('nama', $data->nama)->first();
                        $kecamatan = Wilayah::find($data->kode_wilayah);
                        $kabupaten = Wilayah::find($kecamatan->kode_wilayah);
                        $provinsi = Wilayah::find($kabupaten->kode_wilayah);
                        if(!$provinsi){
                            $provinsi = Wilayah::create([
                                'kode_wilayah' => $kabupaten->kode_wilayah,
                                'nama' => $kabupaten->nama,
                                'id_level_wilayah' => $kabupaten->id_level_wilayah,
                                'mst_kode_wilayah' => $kabupaten->mst_kode_wilayah,
                            ]);
                        }
                        if(!$kabupaten){
                            $kabupaten = Wilayah::create([
                                'kode_wilayah' => $kecamatan->kode_wilayah,
                                'nama' => $kecamatan->nama,
                                'id_level_wilayah' => $kecamatan->id_level_wilayah,
                                'mst_kode_wilayah' => $kecamatan->mst_kode_wilayah,
                            ]);
                        }
                        if(!$kecamatan){
                            $kecamatan = Wilayah::create([
                                'kode_wilayah' => $data->kode_wilayah,
                                'nama' => $data->nama,
                                'id_level_wilayah' => $data->id_level_wilayah,
                                'mst_kode_wilayah' => $data->mst_kode_wilayah,
                            ]);
                        }
                    }
                }
                Peserta_didik::updateOrCreate(
                    [
                        'peserta_didik_id' => $data->peserta_didik_id,
                    ],
                    [
                        'nama' => $data->nama,
                        'nisn' => $data->nisn,
                        'nik' => $data->nik,
                        'jenis_kelamin' => $data->jenis_kelamin,
                        'tempat_lahir' => $data->tempat_lahir,
                        'tanggal_lahir' => $data->tanggal_lahir,
                        'agama_id' => $data->agama_id,
                        'anak_ke' => $data->anak_keberapa ?? 0,
                        'alamat' => $data->alamat_jalan,
                        'rt' => $data->rt,
                        'rw' => $data->rw,
                        'desa' => $desa ?? NULL,
                        'kecamatan' => ($kecamatan) ? $kecamatan->kode_wilayah : NULL,
                        'kabupaten' => ($kabupaten) ? $kabupaten->kode_wilayah : NULL,
                        'provinsi' => ($provinsi) ? $provinsi->kode_wilayah : NULL,
                        'kode_pos' => $data->kode_pos,
                        'no_telp' => $data->nomor_telepon_seluler,
                        'email' => ($data->email) ? $data->email : $this->generateEmail(),
                        'nama_ayah' => $data->nama_ayah,
                        'nama_ibu' => $data->nama_ibu_kandung,
                        'kerja_ayah' => ($data->pekerjaan_id_ayah) ? get_pekerjaan($data->pekerjaan_id_ayah) : NULL,
                        'kerja_ibu' => ($data->pekerjaan_id_ibu) ? get_pekerjaan($data->pekerjaan_id_ibu) : NULL,
                    ]
                );
                Registrasi_pd::firstOrCreate(
                    [
                        'registrasi_id' => $data->registrasi_id,
                    ],
                    [
                        'peserta_didik_id' => $data->peserta_didik_id,
                        'sekolah_id' => $this->sekolah->sekolah_id,
                        'jenis_pendaftaran' => jenis_pendaftaran($data->jenis_pendaftaran_id),
                        'no_induk' => $data->nipd,
                        'tanggal_masuk_sekolah' => $data->tanggal_masuk_sekolah,
                        /*'jenis_keluar_id' => $data->jenis_keluar_id,
                        'tanggal_keluar' => $data->tanggal_keluar,
                        'keterangan' => $data->keterangan,
                        'no_skhun' => $data->no_skhun,
                        'no_seri_ijazah' => $data->no_seri_ijazah,
                        'sekolah_asal' => $data->sekolah_asal,*/
                    ]
                );
                Anggota_rombel::firstOrCreate(
                    [
                        'anggota_rombel_id' => $data->anggota_rombel_id,
                    ],
                    [
                        'rombongan_belajar_id' => $data->rombongan_belajar_id,
                        'peserta_didik_id' => $data->peserta_didik_id,
                        'semester_id' => $this->getSemester()->semester_id,
                    ]
                );
                $this->create_user($data, 'pd');
            }
        } else {
            $this->alert('error', 'Data kosong. Sekolah '.$this->sekolah->nama.' belum sinkron Dapodik');
        }
    }
    private function generateEmail(){
        $random = Str::random(6);
        return strtolower($random).'@darulkaromah.sch.id';
    }
}
