<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat_tembusan extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'surat_tembusan';
	protected $primaryKey = 'surat_tembusan_id';
	protected $guarded = [];
}
