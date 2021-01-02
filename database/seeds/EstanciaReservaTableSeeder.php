<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstanciaReservaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estancia_reserva')->delete();
        $reservas = range(1, 50);
        $estancias = range(1, 50);
        shuffle($reservas);
        shuffle($estancias);

        for ($i = 0; $i < 50; $i++) {
            DB::table('estancia_reserva')->insert([
                'estancia_id' => $reservas[$i], 
                'reserva_id' => $estancias[$i]
            ]);
        }
    }
}
