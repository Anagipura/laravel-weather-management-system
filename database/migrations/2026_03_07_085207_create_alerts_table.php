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
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
            $table->string('location'); // user's location based on coords (used)
            $table->string('alert-type'); // storm / rainy / flood / dry
            $table->string('description'); // description about the alert
            $table->string('severity');// // low / medium / High
            $table->string("created_at");//(use
            $table->string("updated_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alerts');
    }
};
