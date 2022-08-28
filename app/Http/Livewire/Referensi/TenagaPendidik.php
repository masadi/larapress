<?php

namespace App\Http\Livewire\Referensi;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use App\Models\Ptk;
use App\Models\Sekolah;

class TenagaPendidik extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortby = 'nama';
    public $sortbydesc = 'ASC';
    public $per_page = 10;
    
    public $sekolah_id;
    public $ptk_id;

    public function updatingSearch(){
        $this->resetPage();
    }
    public function loadPerPage(){
        $this->resetPage();
    }
    public function filterSekolah(){
        $this->resetPage();
    }
    public function render(){
        return view('livewire.referensi.tenaga-pendidik', [
            'collection' => Ptk::with(['sekolah' => function($query){
                $query->where('tahun_ajaran_id', session('tahun_ajaran_id'));
                $query->where('ptk_induk', 1);
            }])
            ->orderBy($this->sortby, $this->sortbydesc)
            ->when($this->search, function($query) {
                $query->where('nama', 'ILIKE', '%' . $this->search . '%');
                //$query->orWhere('nuptk', 'ILIKE', '%' . $this->search . '%');
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
    public function getID($aksi, $ptk_id){
        $this->ptk_id = $ptk_id;
    }
}
