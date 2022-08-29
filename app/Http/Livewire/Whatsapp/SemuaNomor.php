<?php

namespace App\Http\Livewire\Whatsapp;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Post;

class SemuaNomor extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $sortby = 'created_at';
    public $sortbydesc = 'DESC';
    public $per_page = 10;
    public $search = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function loadPerPage(){
        sleep(10);
        $this->resetPage();
    }
    
    public function render()
    {
        return view('livewire.whatsapp.semua-nomor', [
            'collection' => Post::where('type', 'post')->with(['user'])
            ->withCount('comments')
            ->orderBy($this->sortby, $this->sortbydesc)
                ->when($this->search, function($query) {
                    $query->where('title', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('content', 'LIKE', '%' . $this->search . '%');
            })->paginate($this->per_page)
        ]);
    }
}
