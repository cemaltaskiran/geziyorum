<?php

use Illuminate\Database\Seeder;
use App\Media;

class MediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $media = new Media();
        $media->path = 'non.png';
        $media->name = 'non.png';
        $media->media_type_id = 1;
        $media->ip = '127.0.0.1';
        $media->save();

        $media = new Media();
        $media->path = 'img.jpg';
        $media->name = 'img.jpg';
        $media->media_type_id = 2;
        $media->ip = '127.0.0.1';
        $media->save();
    }
}
