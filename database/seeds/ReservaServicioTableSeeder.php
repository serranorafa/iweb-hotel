<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reserva_servicio')->delete();
        $reservas = range(1, 50);
        $servicios = range(1, 6);
        shuffle($reservas);
        shuffle($servicios);

        for ($i = 1; $i < 50; $i++) {
            DB::table('reserva_servicio')->insert([
                'reserva_id' => $reservas[$i], 
                'servicio_id' => $servicios[$i / 10]
            ]);
        }
    }
}
