<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yayasan extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'yayasan';
	protected $primaryKey = 'yayasan_id';
	protected $guarded = [];

    public function getNamaDesaAttribute()
	{
        return ($this->attributes['desa']) ? $this->get_desa()->first()->nama : '';
	}
    
    public function get_desa()
    {
        return $this->belongsTo(Wilayah::class, 'desa');
    }
    public function getNamaKecamatanAttribute()
	{
        return ($this->attributes['kecamatan']) ? $this->get_kecamatan()->first()->nama : '';
	}
    
    public function get_kecamatan()
    {
        return $this->belongsTo(Wilayah::class, 'kecamatan');
    }
    public function getNamaKabupatenAttribute()
	{
        return ($this->attributes['kabupaten']) ? $this->get_kabupaten()->first()->nama : '';
	}
    
    public function get_kabupaten()
    {
        return $this->belongsTo(Wilayah::class, 'kabupaten');
    }
    public function getNamaProvinsiAttribute()
	{
        return ($this->attributes['provinsi']) ? $this->get_provinsi()->first()->nama : '';
	}
    
    public function get_provinsi()
    {
        return $this->belongsTo(Wilayah::class, 'provinsi');
    }
}
