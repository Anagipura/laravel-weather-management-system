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
        Schema::create('risklevels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("country"); // LK/ IND/ MV
            $table->string("risklevel"); // low/ medium/ high
            $table->string("description");// description according to the country risk level
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
