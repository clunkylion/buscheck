<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('status', 50)->nullable();
            $table->string('photo');
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
        Schema::dropIfExists('bus_photos');
    }
}
