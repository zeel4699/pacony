<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->enum('type', ['icon', 'image']);
            $table->enum('image_status', ['show', 'hide'])->default('show');
            $table->text('info_image')->nullable();
            $table->string('icon')->nullable();
            $table->string('title');
            $table->string('desc');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_lists');
    }
}
