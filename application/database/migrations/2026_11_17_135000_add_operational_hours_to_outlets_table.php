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
        Schema::table('outlets', function (Blueprint $table) {
            if (!Schema::hasColumn('outlets', 'open_hour')) {
                $table->string('open_hour')->nullable()->default('08:30');
            }
            if (!Schema::hasColumn('outlets', 'close_hour')) {
                $table->string('close_hour')->nullable()->default('17:00');
            }
            if (!Schema::hasColumn('outlets', 'days')) {
                $table->string('days')->nullable()->default('Senin - Sabtu');
            }
            if (!Schema::hasColumn('outlets', 'operational_hours')) {
                $table->string('operational_hours')->nullable()->default('Senin - Jumat (08:30 - 17:00) | Sabtu (08:30 - 14:00)');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('outlets', function (Blueprint $table) {
            $table->dropColumn(['open_hour', 'close_hour', 'days', 'operational_hours']);
        });
    }
};

