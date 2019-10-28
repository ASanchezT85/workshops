<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWorkshopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_workshop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workshop_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_workshop');
    }
}
