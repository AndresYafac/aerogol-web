<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeporteUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deporte_user', function (Blueprint $table) {
            $table->increments('id');


            //canchas
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            //deporte
            $table->unsignedInteger('deporte_id');
            $table->foreign('deporte_id')->references('id')->on('deportes');

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
        Schema::dropIfExists('deporte_user');
    }
}
