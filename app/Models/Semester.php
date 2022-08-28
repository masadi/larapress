<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    public $incrementing = false;
	protected $table = 'semester';
	protected $primaryKey = 'semester_id';
	protected $guarded = [];
	/**
	 * Get the tahun_ajaran associated with the Semester
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function tahun_ajaran()
	{
		return $this->hasOne(Tahun_ajaran::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
	}
}
