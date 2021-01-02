<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bloqueo;
use Faker\Generator as Faker;

$factory->define(Bloqueo::class, function (Faker $faker) {
    return [
        'fecha_inicio' => $faker->dateTime($max = 'now'),
        'fecha_fin' => $faker->dateTime($min = 'now'),
        'estancia_id' => $faker->numberBetween($min = 1, $max = 49)
    ];
});
