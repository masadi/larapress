<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Pharaonic\Laravel\Images\HasImages; 

class Gallery extends Model
{
    use HasFactory, HasImages;
    protected $guarded = [];
}
