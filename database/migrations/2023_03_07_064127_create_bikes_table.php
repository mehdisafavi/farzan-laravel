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
        if (Schema::hasTable('bikes')) {
            return;
        }

        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('weight');
            $table->integer('price');
            $table->integer('model_id');
            $table->integer('color_id');
            $table->integer('bike_image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};
