<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Delivery', function (Blueprint $table) {
            $table->id('DeliveryID');
            $table->unsignedBigInteger('OrderID');
            $table->unsignedBigInteger('StaffID');
            $table->unsignedBigInteger('ManagerID')->nullable();
            $table->enum('Status', ['Assigned', 'On-going', 'Delivered'])->default('Assigned');
            $table->string('CurrentLocation')->nullable();
            $table->timestamps();

            $table->foreign('OrderID')->references('OrderID')->on('Order')->onDelete('cascade');
            $table->foreign('StaffID')->references('UserID')->on('User')->onDelete('cascade');
            $table->foreign('ManagerID')->references('UserID')->on('User')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Delivery');
    }
};