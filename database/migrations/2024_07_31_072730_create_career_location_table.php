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
        Schema::create('career_location', function (Blueprint $table) {
            $table->id();
            $table->integer('career_id')->nullable()->index('career_location_career_id');
            $table->integer('location_id')->nullable()->index('career_location_location_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_location');
    }
};
