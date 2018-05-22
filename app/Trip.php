<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trip extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'trip_category', 'trip_id', 'category_id');
    }

    public function participants()
    {
        return $this->belongsToMany('App\User', 'user_trip', 'trip_id', 'user_id');
    }

    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    public function medias()
    {
        return $this->hasMany('App\Media');
    }

    public function days()
    {
        return $this->hasMany('App\Day');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function bans()
    {
        return $this->morphMany('App\Ban', 'banable');
    }

}
