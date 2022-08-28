<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombongan_belajar extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'rombongan_belajar';
	protected $primaryKey = 'rombongan_belajar_id';
	protected $guarded = [];
    
    public function anggota_rombel(){
        return $this->hasMany(Anggota_rombel::class, 'rombongan_belajar_id', 'rombongan_belajar_id');
    }
    public function sekolah(){
        return $this->hasOne(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }
    public function ptk(){
        return $this->hasOne(Ptk::class, 'ptk_id', 'ptk_id');
    }
}
