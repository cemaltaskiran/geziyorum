<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function complaint()
    {
        return $this->belongsTo('App\Complaint');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function history()
    {
        return $this->hasMany('App\ReportHistory');
    }
}
