<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function city()
    {
        return $this->belongstoMany('App\City');
}

    public function activities()
    {
        return $this->hasMany('App\Activity');
    }
}
