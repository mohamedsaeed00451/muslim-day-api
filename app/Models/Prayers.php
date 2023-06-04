<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prayers extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar','name_en','time'];
    protected $hidden = ['created_at','updated_at'];

    public function adhkars()
    {
        return $this->hasMany(AfterPrayerAdhkar::class,'prayer_id');
    }
}
