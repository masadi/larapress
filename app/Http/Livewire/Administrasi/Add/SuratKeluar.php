<?php

namespace App\Http\Livewire\Administrasi\Add;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Http\Livewire\Trix;
use App\Models\Surat_keluar;
use App\Models\Sekolah;
use Carbon\Carbon;

class SuratKeluar extends Component
{
    use LivewireAlert, WithFileUploads;
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
    public $content = 'Awesome <strong>Sauce</strong>';

    protected $rules = [
        'sekolah_id' => 'required',
        'nomor' => 'required',
        'tanggal' => 'required',
        'perihal' => 'required',
        'tujuan' => 'required',
        'bentuk_surat' => 'required',
        'berkas' => [
            'nullable',
            'mimes:jpeg,jpg,png,pdf'
        ],
        'content' => 'required_unless:bentuk_surat,file',
    ];
    protected $messages = [
        'sekolah_id.required' => 'Unit Lembaga tidak boleh kosong',
        'nomor.required' => 'Nomor Surat tidak boleh kosong',
        'tanggal.required' => 'Tanggal Surat tidak boleh kosong',
        'perihal.required' => 'Perihal tidak boleh kosong',
        'tujuan.required' => 'Tujuan tidak boleh kosong',
        'bentuk_surat.required' => 'Bentuk Surat tidak boleh kosong',
        'berkas.mimes' => 'Berkas Surat harus berekstensi JPEG/JPG/PDF',
        'content.required_unless' => 'Isi Surat tidak boleh kosong jika Bentuk Surat tidak memilih File!',
    ];

    protected $listeners = [
        'setTanggal',
    ];

    public function render()
    {
        return view('livewire.administrasi.add.surat-keluar', [
            'data_sekolah' => Sekolah::select('sekolah_id', 'nama')->get()
        ]);
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function store(){
        $this->validate();
        if(Str::isUuid($this->sekolah_id)){
            $sekolah_id = $this->sekolah_id;
        } else {
            $sekolah_id = NULL;
        }
        Surat_keluar::create([
            'sekolah_id' => $sekolah_id,
            'semester_id' => session('semester_id'),
            'nomor' => $this->nomor,
            'tanggal' => $this->tanggal,
            'perihal' => $this->perihal,
            'tujuan' => $this->tujuan,
            'content' => $this->content,
        ]);
        $this->flash('success', 'Successfully submitted form', [], '/administrasi/surat-keluar');
    }
    public function setTanggal($tanggal){
        $this->tanggal = Carbon::createFromTimeStamp(strtotime($tanggal))->format('Y-m-d');
        $this->tanggal_str = Carbon::createFromTimeStamp(strtotime($tanggal))->translatedFormat('j F Y');
    }
    public function updatedTemplate(){
        $this->content = $this->template;
        $this->emit('changeContent', [
            'content' => $this->content
        ]);
    }
}
