<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();

            // RELASI
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('guest_id')->nullable();
            $table->unsignedBigInteger('room_id');

            // DATA BOOKING
            $table->date('check_in_date');
            $table->date('check_out_date');
            $table->integer('number_of_nights');

            // HARGA
            $table->decimal('room_price', 12, 2);
            $table->boolean('has_extra_bed')->default(false);
            $table->decimal('extra_bed_price', 10, 2)->default(0);

            $table->enum('booking_type', ['room_only', 'include_breakfast', 'full_package']);
            $table->decimal('additional_facilities_price', 12, 2)->default(0);

            $table->decimal('total_price', 12, 2);
            $table->decimal('down_payment', 12, 2)->default(0);
            $table->decimal('remaining_payment', 12, 2)->default(0);

            // STATUS
            $table->enum('payment_status', ['unpaid', 'dp', 'paid', 'cancelled'])->default('unpaid');
            $table->enum('booking_status', ['pending', 'confirmed', 'checked_in', 'checked_out', 'cancelled'])->default('pending');

            $table->text('notes')->nullable();
            $table->timestamps();

            // FOREIGN KEY (AMAN)
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();

            // ⚠️ aktifkan ini hanya kalau tabel guests sudah ada
            // $table->foreign('guest_id')->references('id')->on('guests')->nullOnDelete();

            $table->foreign('room_id')->references('id')->on('rooms')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};