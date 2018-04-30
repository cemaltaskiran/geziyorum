<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function trips()
    {
        return $this->belongsToMany('App\Trip', 'trip_category', 'category_id', 'trip_id');
    }
}
