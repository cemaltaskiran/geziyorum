<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    public function comments()
    {
        return $this->morphedByMany('App\Comment', 'complaintable');
    }

    public function medias()
    {
        return $this->morphedByMany('App\Media', 'complaintable');
    }

    public function trips()
    {
        return $this->morphedByMany('App\Trip', 'complaintable');
    }

    public function users()
    {
        return $this->morphedByMany('App\User', 'complaintable');
    }

    public function user()
    {
        $userId = $this->user_id;
        return User::find($userId);
    }
}
