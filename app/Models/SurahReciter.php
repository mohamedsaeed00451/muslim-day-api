<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurahReciter extends Model
{
    use HasFactory;
    protected $fillable = ['surah_id','reciter_id'];
}
