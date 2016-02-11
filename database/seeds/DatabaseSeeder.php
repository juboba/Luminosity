<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Task;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(User::class, 50)->create();
        factory(Task::class, 100)->create();
    }


}
