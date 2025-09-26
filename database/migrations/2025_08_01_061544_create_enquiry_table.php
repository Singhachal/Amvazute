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
        Schema::create('enquiry', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Full Name
            $table->string('email'); // Email Address
            $table->string('phone')->nullable(); // Phone Number
            $table->string('subject')->nullable(); // Subject (optional)
            $table->text('message'); // Enquiry Message
            $table->string('attachment')->nullable(); // File path if any
            $table->tinyInteger('status')->default(0); // 0 = pending, 1 = viewed, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiry');
    }
};
