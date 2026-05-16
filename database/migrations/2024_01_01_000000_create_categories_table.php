<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_ar');
            $table->integer('order')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('image', 191)->nullable();
            $table->string('icon', 191)->nullable();
            $table->string('alt_image', 255)->nullable();
            $table->string('alt_icon', 255)->nullable();
            $table->text('short_desc_en')->nullable();
            $table->text('short_desc_ar')->nullable();
            $table->text('long_desc_en')->nullable();
            $table->text('long_desc_ar')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('show_in_home')->nullable();
            $table->boolean('show_in_header')->nullable();
            $table->boolean('show_in_footer')->nullable();
            $table->string('meta_title_en', 255)->nullable();
            $table->string('meta_title_ar', 255)->nullable();
            $table->text('meta_desc_ar')->nullable();
            $table->text('meta_desc_en')->nullable();
            $table->boolean('index')->nullable();
            $table->string('slug_ar', 191)->nullable();
            $table->string('slug_en', 191)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
