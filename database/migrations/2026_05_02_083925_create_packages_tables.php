<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');

            $table->enum('type', [
                'room_only',
                'room_breakfast',
                'room_fullday',
                'dining_only'
            ]);

            $table->decimal('price', 15, 2);
            $table->boolean('include_breakfast')->default(false);
            $table->boolean('include_other_facilities')->default(false);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};