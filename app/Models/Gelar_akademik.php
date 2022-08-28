<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelar_akademik extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'gelar_akademik';
	protected $primaryKey = 'gelar_akademik_id';
	protected $guarded = [];
}
