<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota_rombel extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'anggota_rombel';
	protected $primaryKey = 'anggota_rombel_id';
	protected $guarded = [];
    
    public function peserta_didik()
    {
        return $this->hasOne(Peserta_didik::class, 'peserta_didik_id', 'peserta_didik_id');
    }
}
