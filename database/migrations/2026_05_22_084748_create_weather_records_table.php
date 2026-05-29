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
        Schema::create('weather_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id');
            $table->float('temperature');
            $table->float('humidity');
            $table->float('wind_speed');
            $table->float('pressure');
            $table->float('rainfall')->nullable();
            $table->string('description');
            $table->string('weather_main');
            $table->timestamp('recorded_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather_records');
    }
};
