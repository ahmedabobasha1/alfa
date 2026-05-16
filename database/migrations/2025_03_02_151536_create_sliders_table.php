<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('title2_en')->nullable();
            $table->string('title2_ar')->nullable();
            $table->string('type')->default('home');
            $table->text('text_ar')->nullable();
            $table->text('text_en')->nullable();
            $table->text('second_text_ar')->nullable();
            $table->text('second_text_en')->nullable();
            $table->string('image_en')->nullable();
            $table->string('image_ar')->nullable();
            $table->string('alt_image_en')->nullable();
            $table->string('alt_image_ar')->nullable();
            $table->string('mobile_image_en')->nullable();
            $table->string('mobile_alt_image_en')->nullable();
            $table->string('mobile_image_ar')->nullable();
            $table->string('mobile_alt_image_ar')->nullable();
            $table->integer('order')->nullable()->default(1);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
