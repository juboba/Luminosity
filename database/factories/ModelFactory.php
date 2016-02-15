<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// https://github.com/fzaninotto/Faker#formatters

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(App\Task::class, function ($faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'language_id' => $faker->randomNumber,
        'user_id' => $faker->randomNumber,
    ];
});
