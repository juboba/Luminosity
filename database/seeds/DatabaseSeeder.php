<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;


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
        /*Client::create(array(
            'name' => 'Manuel Serranoa',
            'username' => 'manserod',
            'email' => 'manserod@gmail.com',
            'password' => Hash::make('guay'),
        ));*/

//        for ($i=1; $i <= 10 ; $i++)
//        {
//
//            DB::table('oauth_clients')->insert(
//                [
//                    'id' => $i,
//                    'secret' => "secret$i",
//                    'name' => "cliente$i"
//                ]);
//        }
        $this->call(RoleTableSeeder::class);
    }

}
