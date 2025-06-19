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
        Schema::create('careers', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->index('careers_title');
            $table->string('slug')->nullable()->index('careers_slug');
            $table->string('category')->nullable()->index('careers_category');
            $table->string('types')->nullable()->index('careers_types');
            $table->longText('qualification')->nullable();
            $table->longText('job_desk')->nullable();
            $table->string('status')->nullable()->default('ACTIVE')->index('careers_status');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('careers');
    }
};
