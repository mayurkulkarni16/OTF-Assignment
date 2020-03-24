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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'mobile' => "98" . $faker->unique()->randomNumber('8'),
        'role' => 'normal',
        'status' => 1,
        'profile' => $faker->image('storage/app/public/images', 300, 400),
        'password' => $password ?: $password = bcrypt('secret'),
    ];
});
