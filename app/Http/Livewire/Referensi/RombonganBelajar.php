<?php

namespace App\Http\Livewire\Referensi;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use App\Models\Rombongan_belajar;
use App\Models\Pembelajaran;
use App\Models\Mata_pelajaran;
use App\Models\Mata_pelajaran_sekolah;
use App\Models\Peserta_didik;
use App\Models\Sekolah;

class RombonganBelajar extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortby = 'tingkat_pendidikan_id';
    public $sortbydesc = 'ASC';
    public $per_page = 10;
    
    public $sekolah_id;
    public $sekolah;
    public $rombongan_belajar_id;
    public $kelas;
    public $data_pembelajaran = [];
    public $anggota_rombel = [];
    public $tingkat_pendidikan_id;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function loadPerPage(){
        $this->resetPage();
    }
    public function filterSekolah(){
        $this->resetPage();
    }
    public function render()
    {
        return view('livewire.referensi.rombongan-belajar', [
            'collection' => Rombongan_belajar::with(['sekolah' => function($query){
                $query->select('sekolah_id', 'nama');
            }])
            ->withCount(['anggota_rombel'])
            ->orderBy($this->sortby, $this->sortbydesc)
            ->when($this->search, function($query) {
                $query->where('nama', 'ILIKE', '%' . $this->search . '%');
                $query->orWhereHas('ptk', function($query){
                    $query->where('nama', 'ILIKE', '%' . $this->search . '%');
                });
            })
            ->when($this->sekolah_id, function($query) {
                $query->where('sekolah_id', $this->sekolah_id);
            })
            ->paginate($this->per_page),
            'data_sekolah' => Sekolah::select('sekolah_id', 'nama')->get(),
        ]);
    }
    public function getID($aksi, $rombongan_belajar_id){
        $this->rombongan_belajar_id = $rombongan_belajar_id;
        $rombongan_belajar = Rombongan_belajar::find($this->rombongan_belajar_id);
        $this->tingkat_pendidikan_id = $rombongan_belajar->tingkat_pendidikan_id;
        $this->sekolah = Sekolah::select('sekolah_id', 'npsn', 'email', 'bentuk_pendidikan_id')->find($rombongan_belajar->sekolah_id);
        $this->kelas = $rombongan_belajar->nama;
        $this->{$aksi}();
    }
    public function anggota(){
        $this->anggota_rombel = Peserta_didik::whereHas('anggota_rombel', function($query){
            $query->where('rombongan_belajar_id', $this->rombongan_belajar_id);
        })->orderBy('nama')->get();
        $this->emit('modal-anggota');
    }
    public function pembelajaran(){
        $this->data_pembelajaran = Pembelajaran::where('rombongan_belajar_id', $this->rombongan_belajar_id)->orderBy('mata_pelajaran_id')->get();
        $this->emit('modal-pembelajaran');
    }
    public function sync(){
        $sinkronisasi = sinkronisasi($this->sekolah, 'pembelajaran');
        if($sinkronisasi){
            foreach($sinkronisasi->dapodik as $dapodik){
                Mata_pelajaran::firstOrCreate(
                    [
                        'mata_pelajaran_id' => $dapodik->mata_pelajaran_id,
                    ],
                    [
                        'nama' => $dapodik->nama_mata_pelajaran,
                    ]
                );
                Mata_pelajaran_sekolah::firstOrCreate(
                    [
                        'mata_pelajaran_id' => $dapodik->mata_pelajaran_id,
                        'bentuk_pendidikan_id' => $this->sekolah->bentuk_pendidikan_id,
                        'tingkat' => $this->tingkat_pendidikan_id,
                    ]
                );
                Pembelajaran::updateOrCreate(
                    [
                        'pembelajaran_id' => $dapodik->pembelajaran_id,
                    ],
                    [
                        'sekolah_id' => $dapodik->sekolah_id,
                        'semester_id' => $dapodik->semester_id,
                        'rombongan_belajar_id' => $dapodik->rombongan_belajar_id,
                        'ptk_id' => $dapodik->ptk_id,
                        'mata_pelajaran_id' => $dapodik->mata_pelajaran_id,
                        'nama_mata_pelajaran' => $dapodik->nama_mata_pelajaran,
                    ]
                );
            }
            $this->alert('success', 'Sinkronisasi Pembelajaran Berhasil!');
        } else {
            $this->alert('error', 'Sinkronisasi Pembelajaran Gagal!');
        }
    }
}
