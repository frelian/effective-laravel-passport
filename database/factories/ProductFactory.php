<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_name'   => $faker->word,
        'description'    => $faker->sentence,
        'product_status' => (int) $faker->boolean,
    ];
});
