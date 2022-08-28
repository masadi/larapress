<?php

namespace App\Http\Livewire\Referensi;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Mata_pelajaran;

class MataPelajaran extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortby = 'created_at';
    public $sortbydesc = 'DESC';
    public $per_page = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function loadPerPage(){
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.referensi.mata-pelajaran', [
            'collection' => Mata_pelajaran::with(['jenjang_sekolah', 'tingkat_kelas'])
            ->orderBy($this->sortby, $this->sortbydesc)
            ->when($this->search, function($query) {
                $query->where('nama', 'ILIKE', '%' . $this->search . '%');
            })->paginate($this->per_page),
        ]);
    }
}
