<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //factory(User::class, 50)->create();
        //factory(Task::class, 100)->create();

        //DB::table('clients')->delete();
        Client::create(array(
            'name' => 'Manuel Serranoa',
            'username' => 'manserod',
            'email' => 'manserod@gmail.com',
            'password' => Hash::make('guay'),
        ));


    }

}
