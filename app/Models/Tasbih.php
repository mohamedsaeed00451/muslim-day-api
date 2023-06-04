<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasbih extends Model
{
    use HasFactory;
    protected $fillable = ['text'];
    protected $hidden = ['created_at','updated_at'];
}
