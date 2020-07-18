<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cart;
use Faker\Generator as Faker;

$factory->define(Cart::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return \App\User::all()->random();
        },
        'product_id' => function(){
            return \App\Models\Product::all()->random();
        },
    ];
});
