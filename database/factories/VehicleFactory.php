<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'plate' => substr(str_shuffle("abcdefghijklmnopqrstuvwxyz1234567890"), 0, 6),
        'color' => $faker->colorName,
        'brand_id' => $faker->numberBetween(1,9),
        'type' => rand(0, 1) ? 'private' : 'public',
        'owner_id' => $faker->numberBetween(1,100),
        'driver_id' => $faker->numberBetween(1,100),
    ];
});
