<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Driver;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'middle_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'document_number' => $faker->unique()->numberBetween(1000000000, 9999999999),
        'address' => $faker->address,
        'phone_number' => $faker->e164PhoneNumber,
        'license_type' => rand(0, 1) ? 'c1' : 'b1',
        'city' => $faker->city
    ];
});
