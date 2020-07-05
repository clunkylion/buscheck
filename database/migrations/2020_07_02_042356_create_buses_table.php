<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('status', 45);
            $table->string('patent', 30);
            $table->string('brand', 45);
            $table->string('model', 45);
            $table->integer('numSeats');
            $table->string('technicalReview', 30);
            $table->unsignedBigInteger('driverId');
            $table->unsignedBigInteger('enterpriseId');
            $table->unsignedBigInteger('hourId')->nullable();
            $table->foreign('driverId')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('hourId')->references('id')->on('hours')->onDelete('cascade');
            $table->foreign('enterpriseId')->references('enterpriseId')->on('drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buses');
    }
}
