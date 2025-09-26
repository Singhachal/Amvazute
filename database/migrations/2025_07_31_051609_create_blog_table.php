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
        Schema::create('blog', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('slug')->unique(); // for SEO URLs
            $table->text('description')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('tag')->nullable();
            $table->string('cover_image')->nullable(); // image path
            $table->string('banner_image')->nullable(); // image path
            $table->string('author')->nullable();
            $table->string('related_blog')->nullable();
            $table->boolean('status')->default(1); // 1=active, 0=inactive
            $table->timestamps();

            // foreign key constraint
            $table->foreign('category_id')->references('id')->on('blog_category')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog');
    }
};
