<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'Camping';
        $category->save();

        $category = new Category();
        $category->name = 'Trekking';
        $category->save();

        $category = new Category();
        $category->name = 'Train';
        $category->save();

        $category = new Category();
        $category->name = 'Car';
        $category->save();

        $category = new Category();
        $category->name = 'Bus';
        $category->save();

        $category = new Category();
        $category->name = 'Hitchhiking';
        $category->save();

        $category = new Category();
        $category->name = 'Caravan';
        $category->save();
    }
}
