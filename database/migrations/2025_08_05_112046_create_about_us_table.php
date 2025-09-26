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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Main title
            $table->text('short_description')->nullable(); // Summary or intro
            $table->longText('description')->nullable(); // Full content
            $table->string('image')->nullable(); // Image path (optional)
            $table->tinyInteger('status'); // Show/hide on frontend
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
