<?php

use Faker\Generator as Faker;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $date_time = $faker->date . '' . $faker->time;
    $num = rand(1,5);
    static $password;
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password?:$password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'avatar' => '/avatar/'.$num.'.jpg',
        'is_admin' => false,
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
