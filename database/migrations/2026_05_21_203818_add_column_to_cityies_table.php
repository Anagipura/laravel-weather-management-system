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
        Schema::table('cityies', function (Blueprint $table) {
            $table->string("country")->after('id')->change();
            $table->string('province')->change();
            $table->string("district")->change();
            $table->string('cityName')->change();
            $table->decimal("longitude", 10, 7)->change();
            $table->string("latitude", 10, 7)->change();
            $table->boolean("is_active")->default(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cityies', function (Blueprint $table) {
            //
        });
    }
};
