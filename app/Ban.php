<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    public function banable()
    {
        return $this->morphTo();
    }
}
