<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrasi_pd extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'registrasi_peserta_didik';
	protected $primaryKey = 'registrasi_id';
	protected $guarded = [];
}
