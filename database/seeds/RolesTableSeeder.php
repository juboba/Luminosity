<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;

class RolesTableSeeder extends Seeder{

    public function run()
    {

        Role::create([
            'id'            => 1,
            'name'          => 'admin',
            'description'   => 'Create, Saved, Updated, Show and Deleted.'
        ]);

        Role::create([
            'id'            => 2,
            'name'          => 'Manager',
            'description'   => 'Update and Show.'
        ]);

        Role::create([
            'id'            => 3,
            'name'          => 'User',
            'description'   => 'Only Show methods.'
        ]);
    }

}