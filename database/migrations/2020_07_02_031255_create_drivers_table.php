<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('driverStatus')->nullable();
            $table->unsignedBigInteger('peopleId');
            $table->unsignedBigInteger('enterpriseId');
            $table->foreign('enterpriseId')->references('id')->on('enterprises');
            $table->foreign('peopleId')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drivers');
    }
}
