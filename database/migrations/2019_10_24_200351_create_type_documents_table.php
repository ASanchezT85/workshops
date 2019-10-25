<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lang_id');
            $table->string('name');
            $table->string('acronym');
            $table->enum('state', ['ACTIVE', 'INACTIVE'])->default('INACTIVE');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_documents');
    }
}
