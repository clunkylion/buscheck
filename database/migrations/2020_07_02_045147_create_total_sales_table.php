<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTotalSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('total_sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('totalSale');
            $table->integer('frequentQuantity');
            $table->integer('normalQuantity');
            $table->integer('studentQuantity');
            //totalQuantity is the summation the all passangers
            $table->integer('totalQuantity');
            
            //foreign keys
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('driverId');
            $table->unsignedBigInteger('busId');
            $table->unsignedBigInteger('enterpriseId');
            $table->unsignedBigInteger('hourId');
            //referencing foreign keys 
            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('driverId')->references('id')->on('drivers');
            $table->foreign('busId')->references('id')->on('buses');
            $table->foreign('enterpriseId')->references('id')->on('enterprises');
            $table->foreign('hourId')->references('id')->on('hours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('total_sales');
    }
}
