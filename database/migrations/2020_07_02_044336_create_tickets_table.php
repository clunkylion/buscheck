<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('price');
            $table->integer('serialNumber');
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('enterpriseId');

            $table->foreign('userId')->references('id')->on('users');
            $table->foreign('enterpriseId')->references('enterpriseId')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
