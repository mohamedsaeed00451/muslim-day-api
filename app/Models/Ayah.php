<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at','updated_at'];

    public function surah()
    {
        return $this->belongsTo(Surah::class,'surah_id');
    }

    public function tafsir()
    {
        return $this->hasOne(Tafsir::class,'ayah_id');
    }

}
