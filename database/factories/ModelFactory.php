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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),

        //randomElement : de un array toma alterna uno y lo agrega
        'role'=>$faker->randomElement(['admin','user']), 
    ];
});


$factory->define(App\Product::class, function (Faker\Generator $faker) {
    
    return [
        'user_id' 	=> rand(1,60),
        'name'   	=> $faker->sentence(2),
        'short' 	=> $faker->text(180),
        'body' 		=> $faker->text(800),
        'image' 	=> $faker->imageurl($width=900,$height=680),
    ];
});


$factory->define(App\Record::class, function (Faker\Generator $faker) {
    
    return [
        'browser' 	=> $faker->userAgent(),
    ];
});