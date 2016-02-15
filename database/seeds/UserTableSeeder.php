<?php

use Illuminate\Database\Seeder;

use App\Country;
use App\Language;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::find(1);
        $language = Language::find(1);

        User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'email' => 'doe.john@nomail.com',
            'direction' => 'going up',
            'enabled' => true,
            'country_id' => $country->id,
            'language_id' => $language->id,
        ]);
    }

}