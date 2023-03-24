<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->string('service_name');
            $table->string('demo_url')->nullable();
            $table->string('demo_admin_url')->nullable();
            $table->longText('demo_other_info')->nullable();
            $table->enum('image_status', ['show', 'hide'])->default('show');
            $table->text('service_image')->nullable();
            $table->enum('period', ['monthly', 'annually','onetime']);
            $table->decimal('monthly_price', 19,2)->nullable();
            $table->decimal('annually_price', 19,2)->nullable();
            $table->decimal('onetime_price', 19,2)->nullable();
            $table->text('feature_list')->nullable();
            $table->text('non_feature_list')->nullable();
            $table->decimal('tax_value', 19,2)->nullable();
            $table->string('whatsapp_phone_number')->nullable();
            $table->integer('order')->default(0);
            $table->enum('status', ['published', 'draft'])->default('published');
            $table->text('service_slug');
            $table->text('meta_desc')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->enum('breadcrumb_status', ['yes', 'no'])->default('no');
            $table->text('custom_breadcrumb_image')->nullable();
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
        Schema::dropIfExists('services');
    }
}
