<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // FIX: tambah role kasir khusus (tanpa menghapus fitur lama)
            $table->enum('role', [
            'admin',
            'owner',
            'ceo',
            'resepsionis',
            'kasir_hotel',
            'kasir_restoran',
            'customer'
        ])->default('customer');
            // tetap dipertahankan
            $table->enum('kasir_type', ['hotel', 'restoran'])->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};