<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bloqueo;
use Faker\Generator as Faker;

$factory->define(Bloqueo::class, function (Faker $faker) {
    $int = mt_rand(1577836800, 1611100800);
    $fechaInicio = date("Y-m-d H:i:s", $int);
    $dias = rand(1, 3);
    $fechaFin = date("Y-m-d H:i:s", strtotime($fechaInicio. ' + ' . $dias . ' days'));

    return [
        'fecha_inicio' => $faker->dateTimeInInterval($fechaInicio),
        'fecha_fin' => $faker->dateTimeInInterval($fechaFin),
        'estancia_id' => $faker->numberBetween($min = 1, $max = 150)
    ];
});
