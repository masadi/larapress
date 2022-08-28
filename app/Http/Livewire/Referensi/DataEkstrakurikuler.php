<?php

namespace App\Http\Livewire\Referensi;

use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Ekstrakurikuler;
use App\Models\Sekolah;
use App\Models\Anggota_ekskul;

class DataEkstrakurikuler extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortby = 'created_at';
    public $sortbydesc = 'DESC';
    public $per_page = 10;

    public $ekstrakurikler_id;
    public $sekolah;
    public $satuan = 'anggota_ekskul_by_rombel';

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
        return view('livewire.referensi.data-ekstrakurikuler', [
            'collection' => Ekstrakurikuler::with(['ptk' => function($query){
                $query->select('ptk_id', 'nama');
            }])
            ->withCount(['anggota_ekskul'])
            ->orderBy($this->sortby, $this->sortbydesc)
            ->when($this->search, function($query) {
                $query->where('nama', 'ILIKE', '%' . $this->search . '%');
                $query->orWhereHas('ptk', function($query){
                    $query->where('nama', 'ILIKE', '%' . $this->search . '%');
                });
            })->paginate($this->per_page),
            'data_sekolah' => Sekolah::select('sekolah_id', 'nama')->get(),
        ]);
    }
    public function syncAnggota($ekstrakurikuler_id){
        $this->ekstrakurikuler_id = $ekstrakurikuler_id;
        $ekstrakurikuler = Ekstrakurikuler::find($this->ekstrakurikuler_id);
        $this->sekolah = Sekolah::find($ekstrakurikuler->sekolah_id);
        $dapodik = $this->ambil_data($ekstrakurikuler->rombongan_belajar_id);
        if($dapodik){
            $this->proses_anggota($dapodik);
            $this->alert('success', 'Sinkronisasi selesai');
        } else {
            $this->alert('error', 'Server tidak merespon!');
        }
    }
    private function proses_anggota($dapodik){
        if($dapodik->dapodik){
            foreach($dapodik->dapodik as $data){
                Anggota_ekskul::updateOrCreate(
                    [
                        'anggota_ekskul_id' => $data->anggota_rombel_id
                    ],
                    [
                        'sekolah_id' => $data->sekolah_id,
                        'ekstrakurikuler_id' => $this->ekstrakurikuler_id,
                        'peserta_didik_id' => $data->peserta_didik_id,
                        'semester_id' => $data->semester_id,
                    ]
                );
            }
        } else {
            $this->alert('error', 'Data kosong. Sekolah '.$this->sekolah->nama.' belum sinkron Dapodik');
        }
    }
    public function ambil_data($rombongan_belajar_id){
        $data_sync = [
            'username_dapo'		=> $this->sekolah->email,
            'npsn'				=> $this->sekolah->npsn,
            'tahun_ajaran_id'	=> session('tahun_ajaran_id'),
            'semester_id'		=> session('semester_id'),
            'sekolah_id'		=> $this->sekolah->sekolah_id,
            'satuan'            => $rombongan_belajar_id,
            //'updated_at'        => ($updated_at) ? Carbon::parse($updated_at)->format('Y-m-d H:i:s') : NULL,
            //'last_sync'         => NULL,
        ];
        $response = Http::withHeaders([
            'x-api-key' => $this->sekolah->sekolah_id,
        ])->withBasicAuth('admin', '1234')->asForm()->post('http://103.40.55.242/erapor_server/api/'.$this->satuan, $data_sync);
        if($response->status() == 200){
            return $response->object();
        } else {
            dd($response->object());
            return false;
        }
    }
}
