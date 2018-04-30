<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function trip()
    {
        return $this->belongsTo('App\Trip');
    }

    public function complaints()
    {
        return $this->morphToMany('App\Complaint', 'complaintable');
    }

    public function ban()
    {
        return $this->morphMany('App\Ban', 'banable');
    }
}
