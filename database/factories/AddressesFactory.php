<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
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

$factory->define(Address::class, function (Faker $faker) {
    return [
        'uuid' => (string) $faker->uuid,
        'city' => $faker->city,
        'country' => $faker->countryCode,
        'street' => $faker->streetName,
        'neighborhood' => $faker->latitude,
        'postal_code' => $faker->postcode,
        'cellular_number' => $faker->numberBetween(12,20),
    ];
});
