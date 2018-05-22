<?php

use Illuminate\Database\Seeder;
use App\Complaint;

class ComplaintsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media = new Complaint();
        $media->name = 'Spam trip';
        $media->description = 'This trip has no content it is just a spam.';
        $media->type = 'trip';
        $media->save();

        $media = new Complaint();
        $media->name = 'Bad cover image';
        $media->description = 'Cover image\'s resolution is bad';
        $media->type = 'trip';
        $media->save();
    }
}
