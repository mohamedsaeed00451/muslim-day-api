<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MorningEveningAdhkar extends Model
{
    use HasFactory;

    protected $fillable = ['text','type'];
    protected $hidden = ['created_at','updated_at'];
}
