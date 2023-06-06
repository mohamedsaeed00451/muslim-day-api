<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    protected $fillable = ['audio','surah_id','reciter_id'];
    protected $hidden = ['created_at','updated_at'];
}
