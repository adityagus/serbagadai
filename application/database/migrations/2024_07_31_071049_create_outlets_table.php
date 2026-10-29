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
        Schema::create('outlets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index('outlets_name');
            $table->string('province_id')->nullable()->index('outlets_province_id');
            $table->text('address')->nullable();
            $table->string('lat_lng')->nullable();
            $table->string('status')->nullable()->default('ACTIVE')->index('outlets_status');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('outlets');
    }
};
