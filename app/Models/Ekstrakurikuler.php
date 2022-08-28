<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'ekstrakurikuler';
	protected $primaryKey = 'ekstrakurikuler_id';
	protected $guarded = [];
    
    public function ptk()
    {
        return $this->hasOne(Ptk::class, 'ptk_id', 'ptk_id');
    }
    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }
    public function anggota_ekskul()
    {
        return $this->hasMany(Anggota_ekskul::class, 'ekstrakurikuler_id', 'ekstrakurikuler_id');
    }
}
