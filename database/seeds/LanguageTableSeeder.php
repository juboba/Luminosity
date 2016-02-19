<?php

use Illuminate\Database\Seeder;
use App\Language;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Language::create([
            'id' => 1,
            'name' => 'Spanish',
            'prefix' => 'ES',
        ]);
    }
}
