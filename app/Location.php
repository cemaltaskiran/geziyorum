<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    public function medias()
    {
        return $this->hasMany('App\Media');
    }
}
