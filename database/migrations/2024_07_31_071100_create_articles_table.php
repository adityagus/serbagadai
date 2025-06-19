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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->index('articles_title');
            $table->string('slug')->nullable()->index('articles_slug');
            $table->string('featured_image')->nullable()->default('default.png');
            $table->string('banner_image')->nullable()->default('default.png');
            $table->longText('content')->nullable();
            $table->string('status')->nullable()->default('ACTIVE')->index('articles_status');
            $table->dateTime('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
