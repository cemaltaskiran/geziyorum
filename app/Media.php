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

    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getMedia(){
        return '/storage/'.$this->user_id.'/'.$this->media_type_id.'/'.$this->trip_id.'/'.$this->location_id.'/'.$this->path;
    }
}
