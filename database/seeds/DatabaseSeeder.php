<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MediaTypesTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(TripTableSeeder::class);
    }
}
