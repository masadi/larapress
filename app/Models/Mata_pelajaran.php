<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mata_pelajaran extends Model
{
    use HasFactory;
    public $incrementing = false;
	protected $table = 'mata_pelajaran';
	protected $primaryKey = 'mata_pelajaran_id';
	protected $guarded = [];
	public function jenjang_sekolah()
    {
        return $this->hasManyThrough(
			Bentuk_pendidikan::class, 
			Mata_pelajaran_sekolah::class,
			'mata_pelajaran_id',
			'bentuk_pendidikan_id',
			'mata_pelajaran_id',
			'bentuk_pendidikan_id',
		);
    }
	public function tingkat_kelas()
    {
        return $this->hasMany(Mata_pelajaran_sekolah::class, 'mata_pelajaran_id', 'mata_pelajaran_id')->orderBy('tingkat');
    }
}
