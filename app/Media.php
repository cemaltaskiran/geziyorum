<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $table = 'medias';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getMedia(){
        return '/storage/'.$this->mediaType->path.'/'.$this->path;
    }
}
