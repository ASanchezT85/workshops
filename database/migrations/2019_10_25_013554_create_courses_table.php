<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lang_id');
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->text('description');
            $table->text('headed_to');
            $table->text('deception');
            $table->string('file')->nullable();
            $table->enum('state', ['ACTIVE', 'INACTIVE'])->default('INACTIVE');
            $table->integer('space_available');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
