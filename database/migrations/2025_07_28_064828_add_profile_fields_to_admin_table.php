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
            $table->string('number')->nullable()->after('status');
            $table->string('profile_picture')->nullable()->after('number');
            $table->text('bio')->nullable()->after('profile_picture');
            $table->json('post_gallery')->nullable()->after('bio');
        });
    }

public function down()
{
    Schema::table('admin', function (Blueprint $table) {
        $table->dropColumn('number');
        $table->dropColumn('profile_picture');
        $table->dropColumn('bio');
        $table->dropColumn('post_gallery');
    });
}

};
