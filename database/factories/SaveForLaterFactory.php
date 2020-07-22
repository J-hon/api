<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\SaveForLater;
use App\User;
use Faker\Generator as Faker;

$factory->define(SaveForLater::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random();
        },
        'product_id' => function(){
            return Product::all()->random();
        },
    ];
});
