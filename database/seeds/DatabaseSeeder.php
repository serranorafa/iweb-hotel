<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('temporadas')->delete();
        DB::table('estancias')->delete();
        DB::table('bloqueos')->delete();
        DB::table('servicios')->delete();
        DB::table('reservas')->delete();
        //DB::table('estancia_reserva')->delete();
        DB::table('reserva_servicio')->delete();

        $this->call(UsersTableSeeder::class);
        $this->call(TemporadasTableSeeder::class);
        $this->call(EstanciasTableSeeder::class);
        $this->call(BloqueosTableSeeder::class);
        $this->call(ServiciosTableSeeder::class);
        $this->call(ReservasTableSeeder::class);
        //$this->call(EstanciaReservaTableSeeder::class);
        $this->call(ReservaServicioTableSeeder::class);
    }
}
