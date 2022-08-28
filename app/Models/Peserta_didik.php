<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Peserta_didik extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'peserta_didik';
	protected $primaryKey = 'peserta_didik_id';
	protected $guarded = [];

    public function sekolah(){
        return $this->hasOneThrough(
            Sekolah::class,
            Registrasi_pd::class,
            'peserta_didik_id', // Foreign key on the cars table...
            'sekolah_id', // Foreign key on the owners table...
            'peserta_didik_id', // Local key on the mechanics table...
            'sekolah_id' // Local key on the cars table...
        );
    }
    public function getNamaAttribute()
	{
		return strtoupper($this->attributes['nama']);
	}
    public function getTetalaAttribute()
	{
        return strtoupper($this->attributes['tempat_lahir']).', '.Carbon::parse($this->attributes['tanggal_lahir'])->translatedFormat('d F Y');
	}
    public function anggota_rombel(){
        return $this->hasOne(Anggota_rombel::class, 'peserta_didik_id', 'peserta_didik_id');
    }
}
