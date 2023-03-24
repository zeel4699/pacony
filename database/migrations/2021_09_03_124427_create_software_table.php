<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftwareTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->string('category_name');
            $table->integer('category_id');
            $table->text('title');
            $table->text('desc')->nullable();
            $table->text('software_feature_list')->nullable();
            $table->text('server_requirement')->nullable();
            $table->text('tag')->nullable();
            $table->enum('period', ['monthly', 'annually','onetime']);
            $table->decimal('monthly_price', 19,2)->nullable();
            $table->decimal('annually_price', 19,2)->nullable();
            $table->decimal('onetime_price', 19,2)->nullable();
            $table->decimal('tax_value', 19,2)->nullable();
            $table->enum('image_status', ['show', 'hide'])->default('show');
            $table->text('software_image')->nullable();
            $table->text('software_slug');
            $table->text('meta_desc')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->enum('breadcrumb_status', ['yes', 'no'])->default('no');
            $table->text('custom_breadcrumb_image')->nullable();
            $table->text('demo_site_url')->nullable();
            $table->text('demo_panel_url')->nullable();
            $table->text('demo_other_info')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('whatsapp_phone_number')->nullable();
            $table->integer('order')->default(0);
            $table->enum('status', ['published', 'draft'])->default('published');
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
        Schema::dropIfExists('software');
    }
}
