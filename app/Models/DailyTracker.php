<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTracker extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','date','morning','evening','after_prayer','charity','quran','adan'];
    protected $hidden = ['created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
