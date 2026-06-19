<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('room_calendar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained();
            $table->date('date');
            $table->enum('status', ['available', 'booked', 'maintenance']);
            $table->foreignId('booking_id')->nullable()->constrained();
            $table->timestamps();
            $table->unique(['room_id', 'date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_calendar');
    }
};