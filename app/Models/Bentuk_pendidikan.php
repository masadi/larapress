<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bentuk_pendidikan extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'bentuk_pendidikan';
	protected $primaryKey = 'bentuk_pendidikan_id';
	protected $guarded = [];
}
