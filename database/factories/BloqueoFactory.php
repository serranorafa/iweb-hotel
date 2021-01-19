<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bloqueo;
use Faker\Generator as Faker;

$factory->define(Bloqueo::class, function (Faker $faker) {
    return [
        'fecha_inicio' => $faker->dateTimeInInterval($startDate = '-3 days', $interval = '+ 3 days', $timezone = null),
        'fecha_fin' => $faker->dateTimeInInterval($startDate = '-0 days', $interval = '+ 3 days', $timezone = null),
        'estancia_id' => $faker->numberBetween($min = 1, $max = 49)
    ];
});
