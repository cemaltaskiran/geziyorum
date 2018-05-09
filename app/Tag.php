<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function trips()
    {
        return $this->belongsToMany('App\Trip', 'trip_tag', 'tag_id', 'trip_id');
    }
}
