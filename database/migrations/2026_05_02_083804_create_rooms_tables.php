<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 🔥 ROOM TYPES (dibuat di sini karena rooms butuh FK ke room_types)
        Schema::create('room_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->string('foto_url')->nullable();
            $table->timestamps();
        });

        // 🔥 ROOMS
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_type_id')
                  ->constrained('room_types')
                  ->cascadeOnDelete();

            $table->string('room_number')->unique();

            $table->enum('status', [
                'available',
                'booked',
                'occupied',
                'maintenance'
            ])->default('available');

            $table->enum('cleaning_status', [
                'clean',
                'dirty',
                'inspected'
            ])->default('clean');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
        Schema::dropIfExists('room_types');
    }
};