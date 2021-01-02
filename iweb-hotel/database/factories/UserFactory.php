<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    //$rolAux = $faker->boolean(10);
    $rol = array("WEBMASTER", "RECEPCIONISTA", "CLIENTE");
    return [
        'nombre' => $faker->name,
        'apellidos' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt($faker->password(10)), // password,
        'telefono' => $faker->phoneNumber,
        'rol' => $rol[rand(0, 2)],
        'remember_token' => Str::random(10),
    ];
});
