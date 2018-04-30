<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->username = 'cemal';
        $user->email = 'cemaltaskiran@gmail.com';
        $user->password = Hash::make('secret');
        $user->birthdate = '1996-01-02';
        $user->save();
        $user->roles()->attach(Role::where('name', 'default')->first());
        $user->roles()->attach(Role::where('name', 'admin')->first());
    }
}
