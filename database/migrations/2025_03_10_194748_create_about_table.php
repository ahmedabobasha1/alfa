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
        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar', 255);
            $table->string('title_en', 255);
            $table->string('title2_en', 255)->nullable();
            $table->string('title2_ar', 255)->nullable();
            $table->text('short_desc_ar')->nullable();
            $table->text('short_desc_en')->nullable();
            $table->longText('text_ar')->nullable();
            $table->longText('text_en')->nullable();
            $table->string('image', 50)->nullable();
            $table->string('alt_image', 50)->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('alt_icon', 50)->nullable();
            $table->string('icon2', 50)->nullable();
            $table->string('alt_icon2', 50)->nullable();
            $table->string('banner', 50)->nullable();
            $table->string('alt_banner', 50)->nullable();
            $table->string('banner2', 50)->nullable();
            $table->string('alt_banner2', 50)->nullable();
            $table->string('video', 50)->nullable();
            $table->string('alt_video', 50)->nullable();
            $table->string('video_url', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about');
    }
};
