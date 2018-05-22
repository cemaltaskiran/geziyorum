<?php

use Illuminate\Database\Seeder;
use App\Report;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $report = new Report();
        $report->complaint_id = 1;
        $report->complaintable_id = 1;
        $report->complaintable_type = 'trip';
        $report->user_id = 1;
        $report->resolved = false;
        $report->save();
    }
}
