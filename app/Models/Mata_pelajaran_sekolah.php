<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasCompositePrimaryKey;

class Mata_pelajaran_sekolah extends Model
{
    use HasFactory, HasCompositePrimaryKey;
    public $incrementing = false;
	protected $table = 'mata_pelajaran_sekolah';
	protected $primaryKey = ['mata_pelajaran_id', 'bentuk_pendidikan_id', 'tingkat'];
	protected $guarded = [];
}
