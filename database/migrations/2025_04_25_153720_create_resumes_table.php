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
        Schema::create('resumes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('full_name');
            $table->string('title');
            $table->string('email');
            $table->string('phone');
            $table->string('location');
            $table->string('website')->nullable();
            $table->text('about_me');
            $table->string('photo_path')->nullable();
            $table->json('social_links')->nullable();
            $table->json('skills')->nullable();
            $table->json('languages')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
