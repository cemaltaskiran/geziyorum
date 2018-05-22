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
        //$this->call(MediaTypesTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(TripTableSeeder::class);
        $this->call(ComplaintsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
    }
}
