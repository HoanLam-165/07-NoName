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
    Schema::table('User', function (Blueprint $table) {
        $table->unsignedTinyInteger('RoleID')->default(2); // hoặc kiểu phù hợp
    });
}

public function down()
{
    Schema::table('User', function (Blueprint $table) {
        $table->dropColumn('RoleID');
    });
}
};
