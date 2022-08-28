<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun_ajaran extends Model
{
    use HasFactory;
    public $incrementing = false;
	protected $table = 'tahun_ajaran';
	protected $primaryKey = 'tahun_ajaran_id';
	protected $guarded = [];
    /**
     * Get all of the semester for the Tahun_ajaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function semester()
    {
        return $this->hasMany(Semester::class, 'tahun_ajaran_id', 'tahun_ajaran_id');
    }
}
