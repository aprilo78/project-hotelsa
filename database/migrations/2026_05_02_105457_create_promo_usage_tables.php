<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promo_usage', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promo_id')->constrained('promos');
            $table->foreignId('booking_id')->nullable()->constrained('bookings');
            $table->foreignId('restaurant_order_id')->nullable()->constrained('restaurant_orders');
            $table->decimal('discount_amount', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo_usage');
    }
};