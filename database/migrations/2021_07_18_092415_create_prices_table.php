<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->string('package_name');
            $table->string('demo_link')->nullable();
            $table->enum('image_status', ['show', 'hide'])->default('show');
            $table->text('price_image')->nullable();
            $table->enum('period', ['monthly', 'annually','onetime']);
            $table->decimal('monthly_price', 19,2)->nullable();
            $table->decimal('annually_price', 19,2)->nullable();
            $table->decimal('onetime_price', 19,2)->nullable();
            $table->text('feature_list')->nullable();
            $table->text('non_feature_list')->nullable();
            $table->decimal('tax_value', 19,2)->nullable();
            $table->enum('status', ['published', 'draft'])->default('published');
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
        Schema::dropIfExists('prices');
    }
}
