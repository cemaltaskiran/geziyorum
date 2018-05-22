<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ReportHistory;

class Helper extends Model
{
    public function createHistory($reportID, $action){
        $history = new ReportHistory();
        $history->report_id = $reportID;
        $history->action = $action;
        $history->save();
    }
}
