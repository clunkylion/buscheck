<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('status', 60)->default('Disponible');
            $table->integer('number');
            //foreign keys
            $table->unsignedBigInteger('busId');
            $table->unsignedBigInteger('driverId');
            $table->unsignedBigInteger('enterpriseId');

            $table->foreign('busId')->references('id')->on('buses');
            $table->foreign('driverId')->references('driverId')->on('buses');
            $table->foreign('enterpriseId')->references('enterpriseId')->on('buses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
