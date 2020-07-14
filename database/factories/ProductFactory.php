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
    $product = $faker->words(2, true);
    
    return [
        'name'  => $product,
        'slug'  => str_replace(' ','-' , $product),
        'code' => $faker->unique()->numerify('api###'),
        'price' => $faker->randomFloat(2, 10, 100),
        'category_id' => function(){
        	return \App\Category::all()->random();
        },
        'description' => $faker->realText(50),
    ];
});
