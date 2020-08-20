<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function registered()
    {
        return $this->belongsToMany('App\User', 'activity_user');
    }

    public function reviews () 
    {
        return $this->hasMany('App\Review');
    }
}
