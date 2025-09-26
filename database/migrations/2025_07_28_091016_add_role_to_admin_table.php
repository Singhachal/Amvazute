<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('admin', function (Blueprint $table) {
        $table->enum('role', ['admin', 'user'])->default('admin')->after('password');
    });
}

public function down()
{
    Schema::table('admin', function (Blueprint $table) {
        $table->dropColumn('role');
    });
}

};
