<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('Order', function (Blueprint $table) {
            $table->id('OrderID');
            $table->unsignedBigInteger('CustomerID');
            $table->unsignedBigInteger('CategoryID');
            $table->string('FromLocation');
            $table->string('ToLocation');
            $table->decimal('Total', 10, 2);
            $table->decimal('Charge', 10, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreign('CustomerID')->references('UserID')->on('User')->onDelete('cascade');
            $table->foreign('CategoryID')->references('CategoryID')->on('Category')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Order');
    }
};