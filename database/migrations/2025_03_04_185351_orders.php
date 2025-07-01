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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->decimal('total', 10, 2);  // Total harga
            $table->unsignedBigInteger('payment_type_id'); // Kolom untuk menyimpan ID jenis pembayaran
            $table->enum('payment_status', ['pending', 'paid'])->default('pending'); // Status pembayaran
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('payment_type_id')->references('id')->on('payments');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
