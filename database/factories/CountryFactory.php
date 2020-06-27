<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Country;
use Faker\Generator as Faker;

$factory->define(Country::class, function (Faker $faker) {
    return [
        'country' => $faker->country
    ];
});
