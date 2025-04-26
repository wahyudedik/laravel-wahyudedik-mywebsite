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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price_user', 10, 2);
            $table->decimal('price_developer', 10, 2);
            $table->string('category'); // e-book, template, application
            $table->string('image')->nullable();
            $table->string('demo_link')->nullable();
            $table->boolean('featured')->default(false); 
            $table->integer('rating')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
