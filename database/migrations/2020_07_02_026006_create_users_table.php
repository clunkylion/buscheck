<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password', 200);
            $table->string('role');
            $table->unsignedBigInteger('enterpriseId');
            $table->unsignedBigInteger('peopleId');
            $table->string('lastSession');
            $table->integer('userStatus')->nullable();
            $table->rememberToken();
            $table->timestamps();
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
        Schema::dropIfExists('users');
    }
}
