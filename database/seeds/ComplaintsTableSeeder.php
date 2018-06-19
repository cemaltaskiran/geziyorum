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

        $media = new Complaint();
        $media->name = 'Trip media is illegal.';
        $media->description = 'At least one of the trip media has illegal content';
        $media->type = 'trip';
        $media->save();

        $media = new Complaint();
        $media->name = 'Spam comment';
        $media->description = 'This comment is spam.';
        $media->type = 'comment';
        $media->save();
    }
}
