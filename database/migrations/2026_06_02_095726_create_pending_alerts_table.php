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
        Schema::create('pending_alerts', function (Blueprint $table) {
            $table->id();
            //related city
            $table->foreignId('city_id')
                ->nullable()
                ->constrained('cityies')
                ->nullOnDelete();
            // related weather record id
            $table->foreignId('weather_record_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            // generated alert details
            $table->string('title');
            $table->text('message');
            $table->string('type'); // flood/storm/heatwave, or other
            $table->string('location'); // country
            $table->enum('severity',[
                'low',
                'medium',
                'high'
            ]);

            // generated risk score from the alert analyzer
            $table->integer('risk_score')
                ->nullable();

            $table->enum('status',[
                'pending',
                'approved',
                'rejected'
            ])->default('pending');

            // manual or from alert analyzer(Python)
            $table->string('source')
                ->default('alert analyzer(Python)');

            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_alerts');
    }
};
