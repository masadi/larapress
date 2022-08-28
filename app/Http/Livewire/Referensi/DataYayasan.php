<?php

namespace App\Http\Livewire\Referensi;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Yayasan;
use App\Models\Wilayah;

class DataYayasan extends Component
{
    use LivewireAlert;
    public $yayasan_id = '56560480-67a8-4465-92c0-587c91363587';
    public $showForm = FALSE;
    /*public $showForm = [
        'nama' => FALSE,
        'alamat' => FALSE,
        'desa' => FALSE,
        'kecamatan' => FALSE,
        'kabupaten' => FALSE,
        'provinsi' => FALSE,
        'kode_pos' => FALSE,
        'lintang' => FALSE,
        'bujur' => FALSE,
        'no_telp' => FALSE,
        'no_fax' => FALSE,
        'email' => FALSE,
    ];*/
    public $nama;
    public $alamat;
    public $desa;
    public $kecamatan;
    public $kabupaten;
    public $provinsi;
    public $kode_pos;
    public $lintang;
    public $bujur;
    public $no_telp;
    public $no_fax;
    public $email;

    protected $rules = [
        'nama' => 'required',
    ];
    protected $messages = [
        'nama.required' => 'Nama Yayasan tidak boleh kosong!',
    ];

    public function render()
    {
        $get_data = $this->get_data();
        return view('livewire.referensi.data-yayasan', [
            'yayasan' => $get_data,
            'forms' => [
                'nama' => [
                    'alias' => 'nama', 
                    'title' => 'Nama Yayasan*',
                    'type' => 'text',
                ], 
                'alamat' => [
                    'alias' => 'alamat', 
                    'title' => 'Alamat Yayasan',
                    'type' => 'text',
                ], 
                'provinsi' => [
                    'alias' => 'nama_provinsi', 
                    'title' => 'Provinsi',
                    'type' => 'select',
                    'data' => Wilayah::where('id_level_wilayah', 1)->get(),
                ], 
                'kabupaten' => [
                    'alias' => 'nama_kabupaten', 
                    'title' => 'Kabupaten/Kota',
                    'type' => 'select',
                    'data' => ($get_data && $get_data->provinsi) ? Wilayah::where('mst_kode_wilayah', $get_data->provinsi)->where('id_level_wilayah', 2)->get() : [],
                ], 
                'kecamatan' => [
                    'alias' => 'nama_kecamatan', 
                    'title' => 'Kecamatan',
                    'type' => 'select',
                    'data' => ($get_data && $get_data->kabupaten) ? Wilayah::where('mst_kode_wilayah', $get_data->kabupaten)->where('id_level_wilayah', 3)->get() : [],
                ], 
                'desa' => [
                    'alias' => 'nama_desa', 
                    'title' => 'Desa/Kelurahan',
                    'type' => 'select',
                    'data' => ($get_data && $get_data->kecamatan) ? Wilayah::where('mst_kode_wilayah', $get_data->kecamatan)->where('id_level_wilayah', 4)->get() : [],
                ], 
                'kode_pos' => [
                    'alias' => 'kode_pos', 
                    'title' => 'Kodepos',
                    'type' => 'text',
                ], 
                'lintang' => [
                    'alias' => 'lintang', 
                    'title' => 'Lintang',
                    'type' => 'text',
                ], 
                'bujur' => [
                    'alias' => 'bujur', 
                    'title' => 'Bujur',
                    'type' => 'text',
                ], 
                'no_telp' => [
                    'alias' => 'no_telp', 
                    'title' => 'Nomor Telpon',
                    'type' => 'text',
                ], 
                'no_fax' => [
                    'alias' => 'no_fax', 
                    'title' => 'Nomor Fax',
                    'type' => 'text',
                ], 
                'email' => [
                    'alias' => 'email', 
                    'title' => 'Email',
                    'type' => 'text',
                ], 
            ],
        ]);
    }
    public function update(){
        $this->validate();
        $yayasan = Yayasan::updateOrCreate(
            [
                'yayasan_id' => $this->yayasan_id,
            ],
            [
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                //'desa' => ($this->desa) ?? NULL,
                //'kecamatan' => ($this->kecamatan) ?? NULL,
                //'kabupaten' => ($this->kabupaten) ?? NULL,
                //'provinsi' => ($this->provinsi) ?? NULL,
                'kode_pos' => $this->kode_pos,
                'lintang' => $this->lintang,
                'bujur' => $this->bujur,
                'no_telp' => $this->no_telp,
                'no_fax' => $this->no_fax,
                'email' => $this->email,
            ]
        );
        if($this->provinsi){
            $yayasan->provinsi = $this->provinsi;
        }
        if($this->kabupaten){
            $yayasan->kabupaten = $this->kabupaten;
        }
        if($this->kecamatan){
            $yayasan->kecamatan = $this->kecamatan;
        }
        if($this->desa){
            $yayasan->desa = $this->desa;
        }
        if($this->provinsi || $this->kabupaten || $this->kecamatan || $this->desa){
            $yayasan->save();
        }
        $this->alert('success', 'Berhasil', [
            'text' => 'Data Yayasan berhasil diperbaharui'
        ]);
        $this->reset('showForm');
    }
    public function showForm(){
        $this->showForm =! $this->showForm;
        $this->dispatchBrowserEvent('pharaonic.select2.init');
    }
    public function mount(){
        $get_data = $this->get_data();
        $this->nama = ($get_data) ? $get_data->nama : NULL;
        $this->alamat = ($get_data) ? $get_data->alamat : NULL;
        $this->desa = ($get_data) ? $get_data->desa : NULL;
        $this->kecamatan = ($get_data) ? $get_data->kecamatan : NULL;
        $this->kabupaten = ($get_data) ? $get_data->kabupaten : NULL;
        $this->provinsi = ($get_data) ? $get_data->provinsi : NULL;
        $this->kode_pos = ($get_data) ? $get_data->kode_pos : NULL;
        $this->lintang = ($get_data) ? $get_data->lintang : NULL;
        $this->bujur = ($get_data) ? $get_data->bujur : NULL;
        $this->no_telp = ($get_data) ? $get_data->no_telp : NULL;
        $this->no_fax = ($get_data) ? $get_data->no_fax : NULL;
        $this->email = ($get_data) ? $get_data->email : NULL;
    }
    private function get_data(){
        return Yayasan::first();
    }
    public function updatedProvinsi($value){
        if($this->provinsi){
            $data_kabupaten = Wilayah::where('mst_kode_wilayah', $this->provinsi)->where('id_level_wilayah', 2)->get();
            $this->dispatchBrowserEvent('data_kabupaten', ['data_kabupaten' => $data_kabupaten]);
        }
    }
    public function updatedKabupaten($value){
        if($this->kabupaten){
            $data_kecamatan = Wilayah::where('mst_kode_wilayah', $this->kabupaten)->where('id_level_wilayah', 3)->get();
            $this->dispatchBrowserEvent('data_kecamatan', ['data_kecamatan' => $data_kecamatan]);
        }
    }
    public function updatedKecamatan($value){
        if($this->kecamatan){
            $data_desa = Wilayah::where('mst_kode_wilayah', $this->kecamatan)->where('id_level_wilayah', 4)->get();
            $this->dispatchBrowserEvent('data_desa', ['data_desa' => $data_desa]);
        }
    }
}
