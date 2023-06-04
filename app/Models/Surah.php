<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar','name_en'];
    protected $hidden = ['created_at','updated_at'];
    public function ayahs()
    {
        return $this->hasMany(Ayah::class,'surah_id');
    }

    public function reciters()
    {
        return $this->belongsToMany(Reciter::class,'surah_reciters','surah_id');
    }

    public function tafsirs()
    {
        return $this->hasMany(Tafsir::class,'surah_id');
    }

}
