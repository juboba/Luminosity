<?php

use Illuminate\Database\Seeder;

use App\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Chile',
            'prefix' => 'CL',
        ]);
    }

}