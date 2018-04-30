<?php

use Illuminate\Database\Seeder;
use App\MediaType;
use Illuminate\Support\Facades\Storage;

class MediaTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mediaType = new MediaType();
        $mediaType->name = 'profile photo';
        $mediaType->path = 'pp';
        if (!file_exists('/storage/app/public/'.$mediaType->path)){
            Storage::makeDirectory('public/'.$mediaType->path);
        }
        $mediaType->save();

        $mediaType = new MediaType();
        $mediaType->name = 'photo';
        $mediaType->path = 'p';
        if (!file_exists('/storage/app/public/'.$mediaType->path)){
            Storage::makeDirectory('public/'.$mediaType->path);
        }
        $mediaType->save();

        $mediaType = new MediaType();
        $mediaType->name = 'video';
        $mediaType->path = 'v';
        if (!file_exists('/storage/app/public/'.$mediaType->path)){
            Storage::makeDirectory('public/'.$mediaType->path);
        }
        $mediaType->save();

        $mediaType = new MediaType();
        $mediaType->name = 'sound';
        $mediaType->path = 's';
        if (!file_exists('/storage/app/public/'.$mediaType->path)){
            Storage::makeDirectory('public/'.$mediaType->path);
        }
        $mediaType->save();
    }
}
