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
        Schema::create('seo_assistants', function (Blueprint $table) {
            $table->id();
            $table->text('home_meta_title_en')->nullable();
            $table->text('home_meta_desc_en')->nullable();
            $table->text('home_meta_title_ar')->nullable();
            $table->text('home_meta_desc_ar')->nullable();
            $table->boolean('home_index')->default(true);

            $table->text('about_meta_title_en')->nullable();
            $table->text('about_meta_desc_en')->nullable();
            $table->text('about_meta_title_ar')->nullable();
            $table->text('about_meta_desc_ar')->nullable();
            $table->boolean('about_index')->default(true);

            $table->text('contact_meta_title_en')->nullable();
            $table->text('contact_meta_desc_en')->nullable();
            $table->text('contact_meta_title_ar')->nullable();
            $table->text('contact_meta_desc_ar')->nullable();
            $table->boolean('contact_index')->default(true);

            $table->text('blogs_meta_title_en')->nullable();
            $table->text('blogs_meta_desc_en')->nullable();
            $table->text('blogs_meta_title_ar')->nullable();
            $table->text('blogs_meta_desc_ar')->nullable();
            $table->boolean('blogs_index')->default(true);

            $table->text('services_meta_title_en')->nullable();
            $table->text('services_meta_desc_en')->nullable();
            $table->text('services_meta_title_ar')->nullable();
            $table->text('services_meta_desc_ar')->nullable();
            $table->boolean('services_index')->default(true);

            $table->string('products_meta_title_en')->nullable();
            $table->text('products_meta_desc_en')->nullable();
            $table->string('products_meta_title_ar')->nullable();
            $table->text('products_meta_desc_ar')->nullable();
            $table->boolean('products_index')->default(true);

            $table->string('projects_meta_title_en')->nullable();
            $table->text('projects_meta_desc_en')->nullable();
            $table->string('projects_meta_title_ar')->nullable();
            $table->text('projects_meta_desc_ar')->nullable();
            $table->boolean('projects_index')->default(true);

            $table->string('categories_meta_title_en')->nullable();
            $table->text('categories_meta_desc_en')->nullable();
            $table->string('categories_meta_title_ar')->nullable();
            $table->text('categories_meta_desc_ar')->nullable();
            $table->boolean('categories_index')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_assistants');
    }
};
