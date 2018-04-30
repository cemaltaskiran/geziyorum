<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
