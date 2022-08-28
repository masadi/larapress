<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptk_terdaftar extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'ptk_terdaftar';
	protected $primaryKey = 'ptk_terdaftar_id';
	protected $guarded = [];
}
