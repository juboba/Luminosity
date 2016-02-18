<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\Language;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $country = Country::find(1);
        $language = Language::find(1);

        User::create([
            'name' => 'John',
            'surname' => 'Doe',
            'username' => 'Doe',
            'password' => base64_encode('123'),
            'email' => 'doe.john@nomail.com',
            'direction' => 'going up',
            'enabled' => true,
            'country_id' => $country->id,
            'language_id' => $language->id,
        ]);
    }
}
