<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tafsir extends Model
{
    use HasFactory;

    protected $fillable = ['text','surah_id','ayah_id'];
    protected $hidden = ['created_at','updated_at'];

}
