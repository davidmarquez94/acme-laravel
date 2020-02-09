<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Owner;
use Faker\Generator as Faker;

$factory->define(Owner::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
        'middle_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'document_number' => $faker->unique()->numberBetween(1000000000, 9999999999),
        'address' => $faker->address,
        'phone_number' => $faker->e164PhoneNumber,
        'city' => $faker->city
    ];
});
