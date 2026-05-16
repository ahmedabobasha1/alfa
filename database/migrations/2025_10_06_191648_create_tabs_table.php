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
        Schema::create('tabs', function (Blueprint $table) {
            $table->id();
            $table->morphs('tabbable');
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->text('short_desc_en')->nullable();
            $table->text('short_desc_ar')->nullable();
            $table->longText('long_desc_en')->nullable();
            $table->longText('long_desc_ar')->nullable();
            $table->string('icon')->nullable();
            $table->string('alt_icon')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabs');
    }
};
