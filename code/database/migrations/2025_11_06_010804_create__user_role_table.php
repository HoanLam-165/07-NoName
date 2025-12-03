<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('UserRole', function (Blueprint $table) {
            $table->id('UserRoleID');
            $table->unsignedBigInteger('UserID');
            $table->unsignedBigInteger('RoleID');
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('User')->onDelete('cascade');
            $table->foreign('RoleID')->references('RoleID')->on('Role')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('UserRole');
    }
};