<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservas')->delete();

        factory(App\Reserva::class, 50)->create();
    }
}
