<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('restaurant_orders', function (Blueprint $table) {
            $table->id();

            // 🔥 RELASI (AMAN)
            $table->foreignId('guest_id')
                  ->nullable()
                  ->constrained('guests')
                  ->nullOnDelete();

            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->foreignId('room_id')
                  ->nullable()
                  ->constrained('rooms')
                  ->nullOnDelete();

            $table->foreignId('booking_id')
                  ->nullable()
                  ->constrained('bookings')
                  ->nullOnDelete();

            $table->foreignId('kasir_id')
                  ->nullable()
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();

            // 🔥 DATA ORDER
            $table->string('order_number')->unique();
            $table->decimal('total_price', 12, 2);

            // 🔥 PEMBAYARAN
            $table->enum('payment_method', [
                'cash',
                'transfer',
                'credit_card',
                'e_wallet'
            ])->nullable();

            $table->string('bank')->nullable();

            $table->enum('payment_status', [
                'pending',
                'paid',
                'failed',
                'billed_to_room'
            ])->default('pending');

            // 🔥 STATUS ORDER
            $table->enum('order_status', [
                'ordered',
                'preparing',
                'ready',
                'served',
                'cancelled'
            ])->default('ordered');

            // 🔥 FLAG
            $table->boolean('is_billed_to_room')->default(false);
            $table->boolean('is_guest_order')->default(false);

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurant_orders');
    }
};