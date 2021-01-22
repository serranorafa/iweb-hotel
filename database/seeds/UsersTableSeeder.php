<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        factory(App\User::class, 1000)->create();

        DB::table('users')->insert([
            'nombre' => 'admin',
            'apellidos' => 'García Smith',
            'email' => 'admin@iweb.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'telefono' => '666666666',
            'rol' => "WEBMASTER",
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'nombre' => 'recepcionista',
            'apellidos' => 'García Smith',
            'email' => 'recep@iweb.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'telefono' => '666666666',
            'rol' => "RECEPCIONISTA",
            'remember_token' => Str::random(10),
        ]);

        DB::table('users')->insert([
            'nombre' => 'cliente',
            'apellidos' => 'García Smith',
            'email' => 'cliente@iweb.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123'),
            'telefono' => '666666666',
            'rol' => "CLIENTE",
            'remember_token' => Str::random(10),
        ]);
    }
}
