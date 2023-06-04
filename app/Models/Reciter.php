<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reciter extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar','name_en','photo'];
    protected $hidden = ['created_at','updated_at'];

    public function surahs()
    {
        return $this->belongsToMany(Surah::class,'surah_reciters','reciter_id');
    }

}
