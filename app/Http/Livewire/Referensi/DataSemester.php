<?php

namespace App\Http\Livewire\Referensi;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Semester;

class DataSemester extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $sortby = 'semester_id';
    public $sortbydesc = 'DESC';
    public $per_page = 10;
    
    public function render()
    {
        return view('livewire.referensi.data-semester',[
            'collection' => Semester::orderBy($this->sortby, $this->sortbydesc)
                ->when($this->search, function($query) {
                    $query->where('nama', 'ILIKE', '%' . $this->search . '%');
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
    public function aktifkan($semester_id){
        $find = Semester::find($semester_id);
        $find->periode_aktif = 1;
        if($find->save()){
            Semester::where('semester_id', '<>', $semester_id)->update(['periode_aktif' => 0]);
        }
    }
}
