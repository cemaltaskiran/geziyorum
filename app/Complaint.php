<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Complaint extends Model
{
    public function comments()
    {
        return DB::table('reports')->where('type', 'comment')->get();
    }

    public function medias()
    {
        return DB::table('reports')->where('type', 'media')->get();
    }

    public function trips()
    {
        return DB::table('reports')->where('type', 'trip')->get();
    }

    public function users()
    {
        return DB::table('reports')->where('type', 'user')->get();
    }

    public function reports(){
        return $this->hasMany('App\Report');
    }
}
