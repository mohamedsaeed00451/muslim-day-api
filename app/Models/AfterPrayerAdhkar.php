<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AfterPrayerAdhkar extends Model
{
    use HasFactory;

    protected $fillable = ['text','prayer_id'];
    protected $hidden = ['created_at','updated_at'];
}
