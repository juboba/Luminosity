<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Country::create([
            'name' => 'Chile',
            'prefix' => 'CL',
        ]);
    }
}
