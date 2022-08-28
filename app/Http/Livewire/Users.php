<?php

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Role;

class Users extends Component
{
    use WithPagination, LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['generatePengguna', 'generatePtk', 'generatePd', 'confirmed'];
    public $search = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function loadPerPage(){
        $this->resetPage();
    }
    public function filterAkses(){
        $this->resetPage();
    }
    public $sortby = 'created_at';
    public $sortbydesc = 'DESC';
    public $per_page = 10;
    public $role_id = '';
    public $user_id;
    public $pengguna;
    public $roles = [];
    public $akses;

    public function render()
    {
        return view('livewire.users', [
            'collection' => User::orderBy($this->sortby, $this->sortbydesc)
                ->when($this->search, function($ptk) {
                    $ptk->where('name', 'ILIKE', '%' . $this->search . '%')
                    //->orWhere('nuptk', 'ILIKE', '%' . $this->search . '%')
                    //->orWhere('nisn', 'ILIKE', '%' . $this->search . '%')
                    ->orWhere('email', 'ILIKE', '%' . $this->search . '%');
                })->when($this->role_id, function($query) {
                    $query->whereRoleIs($this->role_id, session('tahun-ajaran'));
                })->paginate($this->per_page),
            'hak_akses' => Role::get()
        ]);
    }
    public function view($user_id){
        $this->reset(['akses']);
        $this->pengguna = User::find($user_id);
        $this->roles = Role::get();
        $this->emit('openView');
    }
}
