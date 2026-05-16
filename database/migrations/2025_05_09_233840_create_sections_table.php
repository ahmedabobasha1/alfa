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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('second_title_en')->nullable();
            $table->string('second_title_ar')->nullable();
            $table->text('short_desc_en')->nullable();
            $table->text('short_desc_ar')->nullable();
            $table->longText('long_desc_en')->nullable();
            $table->longText('long_desc_ar')->nullable();
            $table->string('image')->nullable();
            $table->string('alt_image')->nullable();
            $table->string('icon')->nullable();
            $table->string('alt_icon')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
