<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptk extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'ptk';
	protected $primaryKey = 'ptk_id';
	protected $guarded = [];
    public function sekolah(){
        return $this->hasOneThrough(
            Sekolah::class,
            Ptk_terdaftar::class,
            'ptk_id', // Foreign key on the cars table...
            'sekolah_id', // Foreign key on the owners table...
            'ptk_id', // Local key on the mechanics table...
            'sekolah_id' // Local key on the cars table...
        );
    }
}
