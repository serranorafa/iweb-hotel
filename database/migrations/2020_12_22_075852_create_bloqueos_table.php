<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloqueosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloqueos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('estancia_id');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin');
            $table->foreign('estancia_id')->references('id')->on('estancias')->onDelete('cascade');
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
        Schema::dropIfExists('bloqueos');
    }
}
