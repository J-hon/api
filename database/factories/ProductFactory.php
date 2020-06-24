<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'  => $faker->words(1, true),
        'slug'  => $faker->words(2, true),
        'code' => $faker->unique()->numerify('api###'),
        'price' => $faker->randomFloat(2, 10, 100),
        'description' => $faker->realText(50),
    ];
});
