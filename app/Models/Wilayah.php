<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'wilayah';
	protected $primaryKey = 'kode_wilayah';
	protected $guarded = [];
	
    public function parent()
    {
        return $this->belongsTo(Wilayah::class, 'mst_kode_wilayah', 'kode_wilayah');
    }
    public function parrentRecursive()
    {
        return $this->parent()->with('parrentRecursive');
    }
}
