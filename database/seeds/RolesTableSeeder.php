<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'default';
        $role->description = 'This is regular user role';
        $role->permissions = 'null';
        $role->save();

        $role = new Role();
        $role->name = 'admin';
        $role->description = 'This is administrator user role';
        $role->permissions = 'null';
        $role->save();
    }
}
