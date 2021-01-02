<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstanciaReservaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estancia_reserva', function (Blueprint $table) {
            $table->unsignedBigInteger('estancia_id');
            $table->unsignedBigInteger('reserva_id');

            $table->foreign('estancia_id')->references('id')->on('estancias')->onDelete('cascade');
            $table->foreign('reserva_id')->references('id')->on('reservas')->onDelete('cascade');

            $table->timestamps();
            $table->primary(['estancia_id', 'reserva_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estancia_reserva');
    }
}
