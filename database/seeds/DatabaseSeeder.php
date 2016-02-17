<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* $this->call(CountryTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(TaskTableSeeder::class);*/
        $this->call(RolesTableSeeder::class);

    }

}
