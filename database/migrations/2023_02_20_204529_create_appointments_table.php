<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');

            $table->string('description');

            //deporte
            $table->unsignedInteger('deporte_id');
            $table->foreign('deporte_id')->references('id')->on('deportes');

            //cancha
            $table->unsignedInteger('court_id');
            $table->foreign('court_id')->references('id')->on('users');

            //client
            $table->unsignedInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users');


            $table->date('schedule_date');
            $table->time('schedule_time');

            $table->string('type');
            
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
        Schema::dropIfExists('appointments');
    }
}
