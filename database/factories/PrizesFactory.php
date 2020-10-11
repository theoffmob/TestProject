<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Prize;
use Faker\Generator as Faker;

$factory->define(Prize::class, function (Faker $faker) {
    return [
        'id' => $faker->numberBetween(1, 100000),
        'typeid' => $faker->numberBetween(1, 3),
        'money' => $faker->numberBetween(1, 1000),
    ];
});
