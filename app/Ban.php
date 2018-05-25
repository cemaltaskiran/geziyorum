<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    public function complaint()
    {
        return $this->belongsTo('App\Complaint');
    }
}
