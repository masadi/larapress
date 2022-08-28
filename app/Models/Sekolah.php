<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'sekolah';
	protected $primaryKey = 'sekolah_id';
	protected $guarded = [];
    public function ptk()
    {
        return $this->hasManyThrough(
            Ptk::class,
            Ptk_terdaftar::class,
            'sekolah_id', // Foreign key on the environments table...
            'ptk_id', // Foreign key on the deployments table...
            'sekolah_id', // Local key on the projects table...
            'ptk_id' // Local key on the environments table...
        );
    }
    public function peserta_didik()
    {
        return $this->hasManyThrough(
            Peserta_didik::class,
            Registrasi_pd::class,
            'sekolah_id', // Foreign key on the environments table...
            'peserta_didik_id', // Foreign key on the deployments table...
            'sekolah_id', // Local key on the projects table...
            'peserta_didik_id' // Local key on the environments table...
        );
    }
    public function rombongan_belajar()
    {
        return $this->hasMany(Rombongan_belajar::class, 'sekolah_id', 'sekolah_id');
    }
}
