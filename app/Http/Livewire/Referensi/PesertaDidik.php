<?php

namespace App\Http\Livewire\Referensi;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use App\Models\Peserta_didik;
use App\Models\Sekolah;

class PesertaDidik extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortby = 'created_at';
    public $sortbydesc = 'DESC';
    public $per_page = 10;
    
    public $sekolah_id;
    public $peserta_didik_id;

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
        return view('livewire.referensi.peserta-didik', [
            'collection' => Peserta_didik::with(['sekolah' => function($query){
                $query->whereNull('jenis_keluar_id');
            }])
            ->orderBy($this->sortby, $this->sortbydesc)
            ->when($this->search, function($query) {
                $query->where('nama', 'ILIKE', '%' . $this->search . '%');
                $query->orWhere('nisn', 'ILIKE', '%' . $this->search . '%');
            })
            ->when($this->sekolah_id, function($query) {
                $query->whereHas('sekolah', function($query){
                    $query->where('sekolah.sekolah_id', $this->sekolah_id);
                });
            })
            ->paginate($this->per_page),
            'data_sekolah' => Sekolah::select('sekolah_id', 'nama')->get(),
        ]);
    }
    public function getID($aksi, $peserta_didik_id){
        $this->peserta_didik_id = $peserta_didik_id;
    }
}
