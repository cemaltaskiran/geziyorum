<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag = new Tag();
        $tag->name = 'Camping';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Trekking';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Train';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Car';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Bus';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Hitchhiking';
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Caravan';
        $tag->save();
    }
}
