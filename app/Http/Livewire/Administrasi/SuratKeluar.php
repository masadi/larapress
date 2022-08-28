<?php

namespace App\Http\Livewire\Administrasi;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Surat_keluar;
use App\Models\Sekolah;

class SuratKeluar extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortby = 'created_at';
    public $sortbydesc = 'DESC';
    public $per_page = 10;
    public $filter_sekolah;

    public $surat_keluar_id;
    public $sekolah_id;
    public $semester_id;
    public $nomor;
    public $tanggal_str;
    public $tanggal;
    public $perihal;
    public $tujuan;
    public $bentuk_surat;
    public $template;
    public $berkas;
    public $content;
    
    protected $listeners = [
        'confirmed'
    ];

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
        return view('livewire.administrasi.surat-keluar', [
            'collection' => Surat_keluar::where('semester_id', session('semester_id'))
            ->orderBy($this->sortby, $this->sortbydesc)
            ->when($this->search, function($query) {
                $query->where('perihal', 'ILIKE', '%' . $this->search . '%');
                $query->orWhere('tujuan', 'ILIKE', '%' . $this->search . '%');
            })
            ->when($this->filter_sekolah, function($query) {
                if(Str::isUuid($this->filter_sekolah)){
                    $query->where('sekolah_id', $this->filter_sekolah);
                } else {
                    $query->whereNull('sekolah_id');
                }
            })
            ->paginate($this->per_page),
            'data_sekolah' => Sekolah::select('sekolah_id', 'nama')->get(),
        ]);
    }
    public function getID($aksi, $surat_keluar_id){
        $this->surat_keluar_id = $surat_keluar_id;
        $this->getData();
        if($aksi == 'hapus'){
            $this->alert('question', 'Apakah Anda yakin?', [
                'text' => 'Tindakan ini tidak dapat dikembalikan!',
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'confirmButtonText' => 'Yakin',
                'showCancelButton' => true,
                'cancelButtonText' => 'Batal',
            ]);
        } else {
            $this->emit($aksi.'-modal');
        }
    }
    public function getData(){
        $surat_keluar = Surat_keluar::find($this->surat_keluar_id);
        $this->sekolah_id = $surat_keluar->sekolah_id;
        $this->semester_id = $surat_keluar->semester_id;
        $this->nomor = $surat_keluar->nomor;
        $this->tanggal = $surat_keluar->tanggal;
        $this->perihal = $surat_keluar->perihal;
        $this->tujuan = $surat_keluar->tujuan;
        $this->berkas = $surat_keluar->berkas;
        $this->content = $surat_keluar->content;
    }
    public function confirmed(){
        $surat_keluar = Surat_keluar::find($this->surat_keluar_id);
        if($surat_keluar->delete()){
            $this->alert('success', 'Surat keluar berhasil dihapus!');
            $this->resetPage();
        } else {
            $this->alert('error', 'Surat keluar gagal dihapus!');
        }
    }
}
