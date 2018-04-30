<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model
{
    protected $table = 'media_types';

    public function medias()
    {
        return $this->hasMany('App\Media');
    }
}
