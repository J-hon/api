<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => function(){
        	return \App\User::all()->random();
        },
        'product_id' => function(){
        	return \App\Product::all()->random();
        },
        'title'  => $faker->words(2, true),
        'description' => $faker->realText(50),
        'rating' => $faker->numberBetween(1, 5),
    ];
});
