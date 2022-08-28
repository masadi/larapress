<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Surat_keluar extends Model
{
    use HasFactory, Uuid;
    public $incrementing = false;
    public $keyType = 'string';
	protected $table = 'surat_keluar';
	protected $primaryKey = 'surat_keluar_id';
	protected $guarded = [];
    /**
     * Get the sekolah associated with the Surat_keluar
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'sekolah_id', 'sekolah_id');
    }
}
