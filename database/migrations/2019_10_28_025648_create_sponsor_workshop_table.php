<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorWorkshopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sponsor_workshop', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('workshop_id');
            $table->unsignedBigInteger('sponsor_id');

            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sponsor_workshop');
    }
}
