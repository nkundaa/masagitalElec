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
            $table->string('id')->primary();
            $table->string('name');
            $table->string('category');
            $table->integer('price');
            $table->integer('original_price')->nullable();
            $table->text('image');
            $table->text('short_description');
            $table->text('description');
            $table->json('specifications');
            $table->json('how_it_works');
            $table->string('youtube_video_id');
            $table->string('tutorial_title');
            $table->boolean('in_stock');
            $table->double('rating');
            $table->integer('reviews');
            $table->string('badge')->nullable();
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
