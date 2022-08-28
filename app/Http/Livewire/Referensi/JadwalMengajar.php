<?php

namespace App\Http\Livewire\Referensi;

use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Sekolah;
use App\Models\Jadwal_mengajar;
use App\Models\Rombongan_belajar;
use App\Models\Pembelajaran;

class JadwalMengajar extends Component
{
    use LivewireAlert;
    public $sekolah_id;
    public $rombongan_belajar_id;
    public $active = 1;
    public $nama_kelas;
    
    public $pembelajaran_id;
    public $alokasi;
    public $jam_ke;

    public $collection = [];
    public $jadwal_mengajar;

    protected $listeners = [
        'confirmed'
    ];
    public function render()
    {
        return view('livewire.referensi.jadwal-mengajar', [
            'data_sekolah' => Sekolah::select('sekolah_id', 'nama')->get(),
            'nama_hari' => $this->hari()->all(),
        ]);
    }
    public function getJadwal($hari){
        $this->reset(['collection']);
        $this->active = $hari;
        if($this->rombongan_belajar_id){
            $this->collection[$hari] = Jadwal_mengajar::where('hari', $hari)->where('rombongan_belajar_id', $this->rombongan_belajar_id)->orderBy('jam_ke')->get();        
        }
    }
    public function hari(){
        return collect([
            ['urut' => 1, 'nama' => 'Senin'],
            ['urut' => 2, 'nama' => 'Selasa'],
            ['urut' => 3, 'nama' => 'Rabu'],
            ['urut' => 4, 'nama' => 'Kamis'],
            ['urut' => 5, 'nama' => 'Jumat'],
            ['urut' => 6, 'nama' => 'Sabtu'],
            ['urut' => 7, 'nama' => 'Ahad']
        ]);
    }
    public function updatedSekolahId($value){
        if($this->sekolah_id){
            $data_rombongan_belajar = Rombongan_belajar::select('rombongan_belajar_id', 'nama')->where(function($query){
                $query->where('semester_id', session('semester_id'));
                $query->where('sekolah_id', $this->sekolah_id);
            })->get();
            $this->dispatchBrowserEvent('data_rombongan_belajar', ['data_rombongan_belajar' => $data_rombongan_belajar]);
        }
    }
    public function updatedRombonganBelajarId($value){
        if($value){
            $this->collection[1] = Jadwal_mengajar::where('hari', 1)->where('rombongan_belajar_id', $value)->orderBy('jam_ke')->get();
            $pembelajaran = Pembelajaran::where('rombongan_belajar_id', $value)->orderBy('mata_pelajaran_id')->get();
            $this->dispatchBrowserEvent('pembelajaran', ['pembelajaran' => $pembelajaran]);
        }
    }
    public function store(){
        $max = ($this->alokasi + $this->jam_ke) - 1;
        for($i=$this->jam_ke;$i<=$max;$i++){
            $find = Jadwal_mengajar::where('pembelajaran_id', $this->pembelajaran_id)->where('jam_ke', $i)->get();
            $hari = [];
            $nama_hari = '';
            foreach($find as $a){
                $dapet = $this->hari()->firstWhere('urut', $a->hari);
                $hari[] = 'hari '.$dapet['nama'].' jam ke '.$a->jam_ke;
            }
            if($hari){
                $nama_hari = "<ul><li>" . collect($hari)->implode('</li><li>'). "</li></ul>";
            }
            $this->validate(
                [
                    'pembelajaran_id' => Rule::unique('jadwal_mengajar')->where(function ($query) use ($i){
                        return $query->where('jam_ke', $i)->where('hari', $this->active);
                    }),
                ],
                [
                    'pembelajaran_id.unique' => 'Mata Pelajaran sudah ada di: '.$nama_hari,
                ]
            );
            Jadwal_mengajar::create([
                'hari' => $this->active,
                'jam_ke' => $i,
                'rombongan_belajar_id' => $this->rombongan_belajar_id,
                'pembelajaran_id' => $this->pembelajaran_id,
            ]);
        }
        $this->collection[$this->active] = Jadwal_mengajar::where('hari', $this->active)->where('rombongan_belajar_id', $this->rombongan_belajar_id)->orderBy('jam_ke')->get();
        $this->emit('close-modal');
    }
    public function delete($id){
        $this->jadwal_mengajar = Jadwal_mengajar::find($id);
        $this->alert('question', 'Apakah Anda Yakin?', [
            'text' => 'Tindakan ini tidak dapat dikembalikan!',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yakin',
            'onConfirmed' => 'confirmed',
            'allowOutsideClick' => false,
            'timer' => null,
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
        ]);
    }
    public function confirmed()
    {
        $this->jadwal_mengajar->delete();
        $this->collection[$this->active] = Jadwal_mengajar::where('hari', $this->active)->where('rombongan_belajar_id', $this->rombongan_belajar_id)->orderBy('jam_ke')->get();
    }
}
