<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('estancia_id');
            $table->unsignedBigInteger('temporada_id');
            $table->unsignedBigInteger('usuario_id');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->integer('precio_total');
            $table->foreign('estancia_id')->references('id')->on('estancias')->onDelete('cascade');
            $table->foreign('temporada_id')->references('id')->on('temporadas')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
}
