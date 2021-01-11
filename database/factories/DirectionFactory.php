<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Direction;
use Faker\Generator as Faker;

$factory->define(Direction::class, function (Faker $faker) {
    return [
        'direction' => $faker->address,
        'user_id'   => rand(1,10),
    ];
});
